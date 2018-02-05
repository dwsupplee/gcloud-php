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

namespace Google\Cloud\PubSub\Tests\Unit\Connection;

use Google\Cloud\PubSub\Connection\ConnectionInterface;
use Google\Cloud\PubSub\Connection\IamTopic;
use Prophecy\Argument;
use PHPUnit\Framework\TestCase;

/**
 * @group pubsub
 */
class IamTopicTest extends TestCase
{
    /**
     * @dataProvider methodProvider
     */
    public function testProxies($methodName, $proxyName, $args)
    {
        $connection = $this->prophesize(ConnectionInterface::class);
        $connection->$proxyName($args)
            ->willReturn($args)
            ->shouldBeCalledTimes(1);

        $iamTopic = new IamTopic($connection->reveal());

        $this->assertEquals($args, $iamTopic->$methodName($args));
    }

    public function methodProvider()
    {
        $args = ['foo' => 'bar'];
        return [
            ['getPolicy', 'getTopicIamPolicy', $args],
            ['setPolicy', 'setTopicIamPolicy', $args],
            ['testPermissions', 'testTopicIamPermissions', $args],
        ];
    }
}
