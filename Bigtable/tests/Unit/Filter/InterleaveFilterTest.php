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
use Google\Cloud\Bigtable\Filter\InterleaveFilter;
use Google\Cloud\Bigtable\V2\RowFilter;
use Google\Cloud\Bigtable\V2\RowFilter\Interleave;
use PHPUnit\Framework\TestCase;

/**
 * @group bigtable
 * @group bigtabledata
 */
class InterleaveFilterTest extends TestCase
{
    private $interleaveFilter;

    public function setUp()
    {
        $this->interleaveFilter = Filter::interleave();
    }

    public function testClass()
    {
        $this->assertInstanceOf(InterleaveFilter::class, $this->interleaveFilter);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Filter can`t be null
     */
    public function testFilterShouldThrowOnNull()
    {
        $this->interleaveFilter->filter(null);
    }

    public function testFilter()
    {
        $interleaveFilter =  $this->interleaveFilter->filter(Filter::pass());
        $this->assertEquals($this->interleaveFilter, $interleaveFilter);
        $interleave = new Interleave();
        $interleave->setFilters([Filter::pass()->toProto()]);
        $rowFilter = new RowFilter();
        $rowFilter->setInterleave($interleave);
        $this->assertEquals($rowFilter, $this->interleaveFilter->toProto());
    }
}
