<?php
/**
 * Copyright 2016 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Google\Cloud\Tests\Unit\BigQuery;

use Google\Cloud\BigQuery\Connection\ConnectionInterface;
use Google\Cloud\BigQuery\CopyJobConfiguration;
use Google\Cloud\BigQuery\ExtractJobConfiguration;
use Google\Cloud\BigQuery\InsertResponse;
use Google\Cloud\BigQuery\Job;
use Google\Cloud\BigQuery\JobConfigurationInterface;
use Google\Cloud\BigQuery\LoadJobConfiguration;
use Google\Cloud\BigQuery\Table;
use Google\Cloud\BigQuery\ValueMapper;
use Google\Cloud\Core\Exception\NotFoundException;
use Google\Cloud\Core\Upload\AbstractUploader;
use Google\Cloud\Storage\Connection\ConnectionInterface as StorageConnectionInterface;
use Google\Cloud\Storage\StorageObject;
use Prophecy\Argument;

/**
 * @group bigquery
 */
class TableTest extends \PHPUnit_Framework_TestCase
{
    const JOB_ID = 'myJobId';
    const PROJECT_ID = 'myProjectId';
    const BUCKET_NAME = 'myBucket';
    const FILE_NAME = 'myfile.csv';
    const TABLE_ID = 'myTableId';
    const DATASET_ID = 'myDatasetId';

    public $connection;
    public $storageConnection;
    public $mapper;
    public $rowData = [
        'rows' => [
            ['f' => [['v' => 'Alton']]]
        ]
    ];
    public $schemaData = [
        'schema' => [
            'fields' => [
                [
                    'name' => 'first_name',
                    'type' => 'STRING'
                ]
            ]
        ]
    ];
    public $insertJobResponse = [
        'jobReference' => [
            'jobId' => self::JOB_ID
        ],
        'status' => [
            'state' => 'RUNNING'
        ]
    ];

    public function setUp()
    {
        $this->mapper = new ValueMapper(false);
        $this->connection = $this->prophesize(ConnectionInterface::class);
        $this->storageConnection = $this->prophesize(StorageConnectionInterface::class);
    }

    public function getObject()
    {
        return new StorageObject(
            $this->storageConnection->reveal(),
            self::FILE_NAME,
            self::BUCKET_NAME
        );
    }

    public function getTable($connection, array $data = [], $tableId = null)
    {
        return new TableStub(
            $connection->reveal(),
            $tableId ?: self::TABLE_ID,
            self::DATASET_ID,
            self::PROJECT_ID,
            $this->mapper,
            $data
        );
    }

    public function testDoesExistTrue()
    {
        $this->connection->getTable(Argument::any())
            ->willReturn([
                'tableReference' => ['tableId' => self::TABLE_ID]
            ])
            ->shouldBeCalledTimes(1);
        $table = $this->getTable($this->connection);

        $this->assertTrue($table->exists());
    }

    public function testDoesExistFalse()
    {
        $this->connection->getTable(Argument::any())
            ->willThrow(new NotFoundException(null))
            ->shouldBeCalledTimes(1);
        $table = $this->getTable($this->connection);

        $this->assertFalse($table->exists());
    }

    public function testDelete()
    {
        $this->connection->deleteTable(Argument::any())
            ->shouldBeCalledTimes(1);
        $table = $this->getTable($this->connection);
        $this->assertNull($table->delete());
    }

    public function testUpdatesData()
    {
        $updateData = ['friendlyName' => 'wow a name', 'etag' => 'foo'];
        $this->connection->patchTable(Argument::that(function ($args) {
            if ($args['restOptions']['headers']['If-Match'] !== 'foo') return false;

            return true;
        }))
            ->willReturn($updateData)
            ->shouldBeCalledTimes(1);
        $table = $this->getTable($this->connection, ['friendlyName' => 'another name']);
        $table->update($updateData);

        $this->assertEquals($updateData['friendlyName'], $table->info()['friendlyName']);
    }

    public function testUpdatesDataWithEtag()
    {
        $updateData = ['friendlyName' => 'wow a name'];
        $this->connection->patchTable(Argument::any())
            ->willReturn($updateData)
            ->shouldBeCalledTimes(1);
        $table = $this->getTable($this->connection, ['friendlyName' => 'another name']);
        $table->update($updateData);

        $this->assertEquals($updateData['friendlyName'], $table->info()['friendlyName']);
    }

    public function testGetsRowsWithNoResults()
    {
        $this->connection->getTable(Argument::any())
            ->willReturn($this->schemaData)
            ->shouldBeCalledTimes(1);
        $this->connection->listTableData(Argument::any())
            ->willReturn([])
            ->shouldBeCalledTimes(1);

        $table = $this->getTable($this->connection);
        $rows = iterator_to_array($table->rows());

        $this->assertEmpty($rows);
    }

    public function testGetsRowsWithoutToken()
    {
        $this->connection->getTable(Argument::any())
            ->willReturn($this->schemaData)
            ->shouldBeCalledTimes(1);
        $this->connection->listTableData(Argument::any())
            ->willReturn($this->rowData)
            ->shouldBeCalledTimes(1);

        $table = $this->getTable($this->connection);
        $rows = iterator_to_array($table->rows());

        $this->assertEquals(
            $this->rowData['rows'][0]['f'][0]['v'],
            $rows[0]['first_name']
        );
    }

    public function testGetsRowsWithToken()
    {
        $name = 'Mike';
        $secondRowData = $this->rowData;
        $secondRowData['rows'][0]['f'][0]['v'] = $name;
        $this->connection->getTable(Argument::any())
            ->willReturn($this->schemaData)
            ->shouldBeCalledTimes(1);
        $this->connection->listTableData(Argument::any())
            ->willReturn(
                $this->rowData + ['nextPageToken' => 'abc'],
                $secondRowData
            )
            ->shouldBeCalledTimes(2);

        $table = $this->getTable($this->connection);
        $rows = iterator_to_array($table->rows());

        $this->assertEquals($name, $rows[1]['first_name']);
    }

    /**
     * @dataProvider jobConfigDataProvider
     */
    public function testRunJob($expectedData, $expectedMethod, $returnedData)
    {
        $jobConfig = $this->prophesize(JobConfigurationInterface::class);
        $jobConfig->toArray()
            ->willReturn($expectedData);
        $this->connection->$expectedMethod($expectedData)
            ->willReturn($returnedData)
            ->shouldBeCalledTimes(1);
        $this->connection->getJob(Argument::any())
            ->willReturn([
                'status' => [
                    'state' => 'DONE'
                ]
            ])
            ->shouldBeCalledTimes(1);
        $table = $this->getTable($this->connection);
        $job = $table->runJob($jobConfig->reveal());

        $this->assertInstanceOf(Job::class, $job);
        $this->assertTrue($job->isComplete());
    }

    /**
     * @dataProvider jobConfigDataProvider
     */
    public function testStartJob($expectedData, $expectedMethod, $returnedData)
    {
        $jobConfig = $this->prophesize(JobConfigurationInterface::class);
        $jobConfig->toArray()
            ->willReturn($expectedData);
        $this->connection->$expectedMethod($expectedData)
            ->willReturn($returnedData)
            ->shouldBeCalledTimes(1);
        $this->connection->getJob(Argument::any())
            ->shouldNotBeCalled();
        $table = $this->getTable($this->connection);
        $job = $table->startJob($jobConfig->reveal());

        $this->assertInstanceOf(Job::class, $job);
        $this->assertFalse($job->isComplete());
        $this->assertEquals($this->insertJobResponse, $job->info());
    }

    public function jobConfigDataProvider()
    {
        $expected = [
            'projectId' => self::PROJECT_ID,
            'jobReference' => [
                'projectId' => self::PROJECT_ID,
                'jobId' => self::JOB_ID
            ]
        ];
        $uploader = $this->prophesize(AbstractUploader::class);
        $uploader->upload()
            ->willReturn($this->insertJobResponse)
            ->shouldBeCalledTimes(1);

        return [
            [
                $expected,
                'insertJob',
                $this->insertJobResponse
            ],
            [
                $expected + ['data' => 'abc'],
                'insertJobUpload',
                $uploader->reveal()
            ]
        ];
    }

    public function testGetsCopyJobConfiguration()
    {
        $destinationTableId = 'destinationTable';
        $destinationTable = $this->getTable($this->connection, [], $destinationTableId);
        $expected = [
            'projectId' => self::PROJECT_ID,
            'configuration' => [
                'copy' => [
                    'destinationTable' => [
                        'datasetId' => self::DATASET_ID,
                        'tableId' => $destinationTableId,
                        'projectId' => self::PROJECT_ID
                    ],
                    'sourceTable' => [
                        'datasetId' => self::DATASET_ID,
                        'tableId' => self::TABLE_ID,
                        'projectId' => self::PROJECT_ID
                    ]
                ]
            ],
            'jobReference' => [
                'projectId' => self::PROJECT_ID,
                'jobId' => self::JOB_ID
            ]
        ];
        $table = $this->getTable($this->connection);
        $config = $table->copy($destinationTable, [
            'jobReference' => ['jobId' => self::JOB_ID]
        ]);

        $this->assertInstanceOf(CopyJobConfiguration::class, $config);
        $this->assertEquals($expected, $config->toArray());
    }

    /**
     * @dataProvider destinationProvider
     */
    public function testGetsExtractJobConfiguration($destinationObject)
    {
        $expected = [
            'projectId' => self::PROJECT_ID,
            'configuration' => [
                'extract' => [
                    'destinationUris' => [
                        'gs://' . self::BUCKET_NAME . '/' . self::FILE_NAME
                    ],
                    'sourceTable' => [
                        'datasetId' => self::DATASET_ID,
                        'tableId' => self::TABLE_ID,
                        'projectId' => self::PROJECT_ID
                    ]
                ]
            ],
            'jobReference' => [
                'projectId' => self::PROJECT_ID,
                'jobId' => self::JOB_ID
            ]
        ];
        $table = $this->getTable($this->connection);
        $config = $table->extract($destinationObject, [
            'jobReference' => ['jobId' => self::JOB_ID]
        ]);

        $this->assertInstanceOf(ExtractJobConfiguration::class, $config);
        $this->assertEquals($expected, $config->toArray());
    }

    public function destinationProvider()
    {
        $this->setUp();

        return [
            [$this->getObject()],
            [sprintf(
                'gs://%s/%s',
                self::BUCKET_NAME,
                self::FILE_NAME
            )]
        ];
    }

    public function testGetsLoadJobConfiguration()
    {
        $data = 'abc';
        $expected = [
            'data' => $data,
            'projectId' => self::PROJECT_ID,
            'configuration' => [
                'load' => [
                    'destinationTable' => [
                        'datasetId' => self::DATASET_ID,
                        'tableId' => self::TABLE_ID,
                        'projectId' => self::PROJECT_ID
                    ]
                ]
            ],
            'jobReference' => [
                'projectId' => self::PROJECT_ID,
                'jobId' => self::JOB_ID
            ]
        ];
        $table = $this->getTable($this->connection);
        $config = $table->load($data, [
            'jobReference' => ['jobId' => self::JOB_ID]
        ]);

        $this->assertInstanceOf(LoadJobConfiguration::class, $config);
        $this->assertEquals($expected, $config->toArray());
    }

    public function testGetsLoadJobConfigurationFromStorage()
    {
        $sourceObject = $this->getObject();
        $expected = [
            'projectId' => self::PROJECT_ID,
            'configuration' => [
                'load' => [
                    'sourceUris' => [
                        'gs://' . self::BUCKET_NAME . '/' . self::FILE_NAME
                    ],
                    'destinationTable' => [
                        'datasetId' => self::DATASET_ID,
                        'tableId' => self::TABLE_ID,
                        'projectId' => self::PROJECT_ID
                    ]
                ]
            ],
            'jobReference' => [
                'projectId' => self::PROJECT_ID,
                'jobId' => self::JOB_ID
            ]
        ];
        $table = $this->getTable($this->connection);
        $config = $table->loadFromStorage($sourceObject, [
            'jobReference' => ['jobId' => self::JOB_ID]
        ]);

        $this->assertInstanceOf(LoadJobConfiguration::class, $config);
        $this->assertEquals($expected, $config->toArray());
    }

    public function testInsertsRow()
    {
        $insertId = '1';
        $rowData = ['key' => 'value'];
        $expectedArguments = [
            'tableId' => self::TABLE_ID,
            'projectId' => self::PROJECT_ID,
            'datasetId' => self::DATASET_ID,
            'rows' => [
                [
                    'json' => $rowData,
                    'insertId' => $insertId
                ]
            ]
        ];
        $this->connection->insertAllTableData($expectedArguments)
            ->willReturn([])
            ->shouldBeCalledTimes(1);
        $table = $this->getTable($this->connection);

        $insertResponse = $table->insertRow($rowData, [
            'insertId' => $insertId
        ]);

        $this->assertInstanceOf(InsertResponse::class, $insertResponse);
        $this->assertTrue($insertResponse->isSuccessful());
    }

    public function testInsertsRows()
    {
        $insertId = '1';
        $data = ['key' => 'value'];
        $rowData = [
            [
                'insertId' => $insertId,
                'data' => $data
            ]
        ];
        $expectedArguments = [
            'tableId' => self::TABLE_ID,
            'projectId' => self::PROJECT_ID,
            'datasetId' => self::DATASET_ID,
            'rows' => [
                [
                    'json' => $data,
                    'insertId' => $insertId
                ]
            ]
        ];
        $this->connection->insertAllTableData($expectedArguments)
            ->willReturn([])
            ->shouldBeCalledTimes(1);
        $table = $this->getTable($this->connection);

        $insertResponse = $table->insertRows($rowData);

        $this->assertInstanceOf(InsertResponse::class, $insertResponse);
        $this->assertTrue($insertResponse->isSuccessful());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInsertRowsThrowsException()
    {
        $table = $this->getTable($this->connection);
        $table->insertRows([[], []]);
    }

    public function testGetsInfo()
    {
        $tableInfo = ['tableReference' => ['tableId' => self::TABLE_ID]];
        $this->connection->getTable(Argument::any())->shouldNotBeCalled();
        $table = $this->getTable($this->connection, $tableInfo);

        $this->assertEquals($tableInfo, $table->info());
    }

    public function testGetsInfoWithReload()
    {
        $tableInfo = ['tableReference' => ['tableId' => self::TABLE_ID]];
        $this->connection->getTable(Argument::any())
            ->willReturn($tableInfo)
            ->shouldBeCalledTimes(1);
        $table = $this->getTable($this->connection);

        $this->assertEquals($tableInfo, $table->info());
    }

    public function testGetsId()
    {
        $table = $this->getTable($this->connection);

        $this->assertEquals(self::TABLE_ID, $table->id());
    }

    public function testGetsIdentity()
    {
        $table = $this->getTable($this->connection);

        $this->assertEquals(self::TABLE_ID, $table->identity()['tableId']);
        $this->assertEquals(self::PROJECT_ID, $table->identity()['projectId']);
    }
}

class TableStub extends Table
{
    protected function generateJobId($jobIdPrefix = null)
    {
        return $jobIdPrefix ? $jobIdPrefix . '-' . BigQueryClientTest::JOBID : BigQueryClientTest::JOBID;
    }
}
