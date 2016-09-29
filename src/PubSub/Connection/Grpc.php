<?php
/**
 * Copyright 2016 Google Inc. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Google\Cloud\PubSub\Connection;

use DrSlump\Protobuf\Codec\PhpArray;
use Google\Auth\CredentialsLoader;
use Google\Auth\HttpHandler\HttpHandlerFactory;
use Google\Cloud\PubSub\V1\PublisherApi;
use Google\Cloud\PubSub\V1\SubscriberApi;
use Grpc\ChannelCredentials;
use google\pubsub\v1\PubsubMessage;
use google\pubsub\v1\PubsubMessage\AttributesEntry as MessageAttributesEntry;
use google\pubsub\v1\PushConfig\AttributesEntry as PushConfigAttributesEntry;
use google\pubsub\v1\PushConfig;

/**
 * Implementation of the
 * [Google Pub/Sub gRPC API](https://cloud.google.com/pubsub/docs/reference/rpc/).
 */
class Grpc implements ConnectionInterface
{
    private $publisherApi;
    private $subscriberApi;

    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $grpcConfig = [
            'credentialsLoader' => CredentialsLoader::makeCredentials($config['scopes'], $config['keyFile'])
        ];

        $this->subscriberApi = new SubscriberApi($grpcConfig);
        $this->publisherApi = new PublisherApi($grpcConfig);
    }

    /**
     * @param array $args
     */
    public function createTopic(array $args)
    {
        return $this->publisherApi->createTopic($args['name'])
            ->serialize(new PhpArray());
    }

    /**
     * @param array $args
     */
    public function getTopic(array $args)
    {
        return $this->publisherApi->getTopic($args['topic'])
            ->serialize(new PhpArray());
    }

    /**
     * @param array $args
     */
    public function deleteTopic(array $args)
    {
        return $this->publisherApi->deleteTopic($args['topic'])
            ->serialize(new PhpArray());
    }

    /**
     * @param array $args
     */
    public function listTopics(array $args)
    {
        $project = $args['project'];
        unset($args['project']);

        $response = $this->publisherApi->listTopics($project, $args)
            ->getPage()
            ->getResponseObject()
            ->serialize(new PhpArray());

        return $this->camelCaseKeys($response);
    }

    /**
     * @param array $args
     */
    public function publishMessage(array $args)
    {
        $topic = $args['topic'];
        $messages = $args['messages'];
        $protobufMessages = [];

        foreach ($messages as $message) {
            $protobufMessage = new PubsubMessage();
            $protobufMessage->setData($message['data']);

            if (isset($message['attributes'])) {
                foreach ($message['attributes'] as $attributeKey => $attributeValue) {
                    $protobufAttribute = new MessagesAttributesEntry();
                    $protobufAttribute->setKey($attributeKey);
                    $protobufAttribute->setValue($attributeValue);

                    $protobufMessage->addAttributes($protobufAttribute);
                }
            }

            $protobufMessages[] = $protobufMessage;
        }

        return $this->publisherApi->publish($topic, $protobufMessages)
            ->serialize(new PhpArray());
    }

    /**
     * @param array $args
     */
    public function listSubscriptionsByTopic(array $args)
    {
        $topic = $args['topic'];
        unset($args['topic']);

        return $this->publisherApi->listTopicSubscriptions($topic, $args);
    }

    /**
     * @param array $args
     */
    public function createSubscription(array $args)
    {
        $subscription = $args['name'];
        $topic = $args['topic'];
        unset($args['name']);
        unset($args['topic']);

        if (isset($args['pushConfig'])) {
            $protobufPushConfig = new PushConfig();
            $protobufPushConfig->setPushEndpoint($args['pushConfig']['pushEndpoint']);

            if (isset($args['pushConfig']['attributes'])) {
                foreach ($args['pushConfig']['attributes'] as $attributeKey => $attributeValue) {
                    $protobufAttribute = new PushConfigAttributesEntry();
                    $protobufAttribute->setKey($attributeKey);
                    $protobufAttribute->setValue($attributeValue);

                    $protobufPushConfig->addAttributes($protobufAttribute);
                }
            }

            $args['pushConfig'] = $protobufPushConfig;
        }

        return $this->subscriberApi->createSubscription($subscription, $topic, $args)
            ->serialize(new PhpArray());
    }

    /**
     * @param array $args
     */
    public function getSubscription(array $args)
    {
        return $this->subscriberApi->getSubscription($args['subscription'])
            ->serialize(new PhpArray());
    }

    /**
     * @param array $args
     */
    public function listSubscriptions(array $args)
    {
        $project = $args['project'];
        unset($args['project']);

        return $this->subscriberApi->listSubscriptions($project, $args)
            ->getPage()
            ->getResponseObject()
            ->serialize(new PhpArray());
    }

    /**
     * @param array $args
     */
    public function deleteSubscription(array $args)
    {
        return $this->subscriberApi->deleteTopic($args['subscription'])
            ->serialize(new PhpArray());
    }

    /**
     * @param array $args
     */
    public function modifyPushConfig(array $args)
    {
        $protobufPushConfig = new PushConfig();
        $protobufPushConfig->setPushEndpoint($args['pushConfig']['pushEndpoint']);

        if (isset($args['pushConfig']['attributes'])) {
            foreach ($args['pushConfig']['attributes'] as $attributeKey => $attributeValue) {
                $protobufAttribute = new PushConfigAttributesEntry();
                $protobufAttribute->setKey($attributeKey);
                $protobufAttribute->setValue($attributeValue);

                $protobufPushConfig->addAttributes($protobufAttribute);
            }
        }

        return $this->subscriberApi->modifyPushConfig($args['subscription'], $protobufPushConfig)
            ->serialize(new PhpArray());
    }

    /**
     * @param array $args
     */
    public function pull(array $args)
    {
        $subscription = $args['subscription'];
        $maxMessages = $args['maxMessages'];
        unset($args['subscription']);
        unset($args['maxMessages']);

        return $this->subscriberApi->pull($subscription, $maxMessages, $args)
            ->serialize(new PhpArray());
    }

    /**
     * @param array $args
     */
    public function modifyAckDeadline(array $args)
    {
        return $this->subscriberApi->modifyAckDeadline($args['subscription'], $args['ackIds'], $args['ackDeadlineSeconds'])
            ->serialize(new PhpArray());
    }

    /**
     * @param array $args
     */
    public function acknowledge(array $args)
    {
        return $this->subscriberApi->acknowledge($args['subscription'], $args['ackIds'])
            ->serialize(new PhpArray());
    }

    /**
     * @param  array $args
     */
    public function getTopicIamPolicy(array $args)
    {

    }

    /**
     * @param  array $args
     */
    public function setTopicIamPolicy(array $args)
    {

    }

    /**
     * @param  array $args
     */
    public function testTopicIamPermissions(array $args)
    {

    }

    /**
     * @param  array $args
     */
    public function getSubscriptionIamPolicy(array $args)
    {

    }

    /**
     * @param  array $args
     */
    public function setSubscriptionIamPolicy(array $args)
    {

    }

    /**
     * @param  array $args
     */
    public function testSubscriptionIamPermissions(array $args)
    {

    }

    /**
     * @todo Replace this! yoinked as a temp fix from - https://gist.github.com/goldsky/3372487
     *
     * Convert under_score type array's keys to camelCase type array's keys
     * @param   array   $array          array to convert
     * @param   array   $arrayHolder    parent array holder for recursive array
     * @return  array   camelCase array
     */
    public function camelCaseKeys($array, $arrayHolder = array()) {
        $camelCaseArray = !empty($arrayHolder) ? $arrayHolder : array();
        foreach ($array as $key => $val) {
            $newKey = @explode('_', $key);
            array_walk($newKey, create_function('&$v', '$v = ucwords($v);'));
            $newKey = @implode('', $newKey);
            $newKey[0] = strtolower($newKey[0]);
            if (!is_array($val)) {
                $camelCaseArray[$newKey] = $val;
            } else {
                @$camelCaseArray[$newKey] = $this->camelCaseKeys($val, $camelCaseArray[$newKey]);
            }
        }
        return $camelCaseArray;
    }
}
