<?php
/**
 * Copyright 2018, Google LLC All rights reserved.
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

namespace Google\Cloud\Bigtable\Tests\Unit\Filter;

use Google\Cloud\Bigtable\Filter;
use Google\Cloud\Bigtable\Filter\QualifierFilter;
use Google\Cloud\Bigtable\Filter\QualifierRangeFilter;
use Google\Cloud\Bigtable\V2\RowFilter;
use PHPUnit\Framework\TestCase;

/**
 * @group bigtable
 * @group bigtabledata
 */
class QualifierFilterTest extends TestCase
{
    private $qualifierFilter;

    public function setUp()
    {
        $this->qualifierFilter = Filter::qualifier();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Value can`t be null
     */
    public function testRegexShouldThrowOnNull()
    {
        $this->qualifierFilter->regex(null);
    }

    public function testRegex()
    {
        $filter = $this->qualifierFilter->regex('v1');
        $this->assertInstanceOf(Filter::class, $filter);
        $rowFilter = new RowFilter();
        $rowFilter->setColumnQualifierRegexFilter('v1');
        $this->assertEquals($rowFilter, $filter->toProto());
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Value can`t be null
     */
    public function testExactMatchShouldThrowOnNull()
    {
        $this->qualifierFilter->exactMatch(null);
    }

    public function testExactMatch()
    {
        $filter = $this->qualifierFilter->exactMatch('v1');
        $this->assertInstanceOf(Filter::class, $filter);
        $rowFilter = new RowFilter();
        $rowFilter->setColumnQualifierRegexFilter('v1');
        $this->assertEquals($rowFilter, $filter->toProto());
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Family can`t be null
     */
    public function testRangeWIthInFamilyShouldThrowOnNullFamily()
    {
        $this->qualifierFilter->rangeWithInFamily(null);
    }
}
