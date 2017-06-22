<?php
/**
 * Copyright 2017 Google Inc. All Rights Reserved.
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

use DrSlump\Protobuf\Codec\CodecInterface;
use Google\Cloud\Core\EmulatorTrait;
use Google\Cloud\Core\GrpcRequestWrapper;
use Google\Cloud\Core\GrpcTrait;
use Google\Cloud\Core\PhpArray;
use Google\Cloud\PubSub\PubSubClient;
use Google\Cloud\PubSub\V1\PublisherClient;
use Google\Cloud\PubSub\V1\SubscriberClient;
use Grpc\ChannelCredentials;
use google\iam\v1\Policy;
use google\protobuf;
use google\pubsub\v1\PubsubMessage;
use google\pubsub\v1\PushConfig;
use google\pubsub\v1\Subscription;

/**
 * Implementation of the
 * [Google Pub/Sub gRPC API](https://cloud.google.com/pubsub/docs/reference/rpc/).
 */
class Grpc implements ConnectionInterface
{
    use EmulatorTrait;
    use GrpcTrait;

    const BASE_URI = 'https://pubsub.googleapis.com/';

    /**
     * @var PublisherClient
     */
    private $publisherClient;

    /**
     * @var SubscriberClient
     */
    private $subscriberClient;

    /**
     * @var CodecInterface
     */
    private $codec;

    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->codec = new PhpArray([
            'publishTime' => function ($v) {
                return $this->formatTimestampFromApi($v);
            },
            'expirationTime' => function ($v) {
                return $this->formatTimestampFromApi($v);
            }
        ]);

        $config['codec'] = $this->codec;
        $this->setRequestWrapper(new GrpcRequestWrapper($config));
        $grpcConfig = $this->getGaxConfig(PubSubClient::VERSION);
        $emulatorHost = getenv('PUBSUB_EMULATOR_HOST');
        $baseUri = $this->getEmulatorBaseUri(self::BASE_URI, $emulatorHost);

        if ($emulatorHost) {
            $grpcConfig += [
                'serviceAddress' => parse_url($baseUri, PHP_URL_HOST),
                'port' => parse_url($baseUri, PHP_URL_PORT),
                'sslCreds' => ChannelCredentials::createInsecure()
            ];
        }

        $this->publisherClient = new PublisherClient($grpcConfig);
        $this->subscriberClient = new SubscriberClient($grpcConfig);
    }

    /**
     * @param array $args
     */
    public function createTopic(array $args)
    {
        return $this->send([$this->publisherClient, 'createTopic'], [
            $this->pluck('name', $args),
            $args
        ]);
    }

    /**
     * @param array $args
     */
    public function getTopic(array $args)
    {
        return $this->send([$this->publisherClient, 'getTopic'], [
            $this->pluck('topic', $args),
            $args
        ]);
    }

    /**
     * @param array $args
     */
    public function deleteTopic(array $args)
    {
        return $this->send([$this->publisherClient, 'deleteTopic'], [
            $this->pluck('topic', $args),
            $args
        ]);
    }

    /**
     * @param array $args
     */
    public function listTopics(array $args)
    {
        return $this->send([$this->publisherClient, 'listTopics'], [
            $this->pluck('project', $args),
            $args
        ]);
    }

    /**
     * @param array $args
     */
    public function publishMessage(array $args)
    {
        $pbMessages = [];
        $messages = $this->pluck('messages', $args);

        foreach ($messages as $message) {
            $pbMessages[] = $this->buildMessage($message);
        }

        return $this->send([$this->publisherClient, 'publish'], [
            $this->pluck('topic', $args),
            $pbMessages,
            $args
        ]);
    }

    /**
     * @param array $args
     */
    public function listSubscriptionsByTopic(array $args)
    {
        return $this->send([$this->publisherClient, 'listTopicSubscriptions'], [
            $this->pluck('topic', $args),
            $args
        ]);
    }

    /**
     * @param array $args
     */
    public function createSubscription(array $args)
    {
        if (isset($args['pushConfig'])) {
            $args['pushConfig'] = $this->buildPushConfig($args['pushConfig']);
        }

        return $this->send([$this->subscriberClient, 'createSubscription'], [
            $this->pluck('name', $args),
            $this->pluck('topic', $args),
            $args
        ]);
    }

    /**
     * @param array $args
     */
    public function updateSubscription(array $args)
    {
        $subscriptionObject = $this->buildSubscription($args);

        $mask = array_keys($subscriptionObject->serialize(new PhpArray([], false)));

        // Remove immutable properties.
        $mask = array_values(array_diff($mask, ['name', 'topic']));

        $fieldMask = (new protobuf\FieldMask())->deserialize(['paths' => $mask], $this->codec);

        return $this->send([$this->subscriberClient, 'updateSubscription'], [
            $subscriptionObject,
            $fieldMask,
            $args
        ]);
    }

    /**
     * @param array $args
     */
    public function getSubscription(array $args)
    {
        return $this->send([$this->subscriberClient, 'getSubscription'], [
            $this->pluck('subscription', $args),
            $args
        ]);
    }

    /**
     * @param array $args
     */
    public function listSubscriptions(array $args)
    {
        return $this->send([$this->subscriberClient, 'listSubscriptions'], [
            $this->pluck('project', $args),
            $args
        ]);
    }

    /**
     * @param array $args
     */
    public function deleteSubscription(array $args)
    {
        return $this->send([$this->subscriberClient, 'deleteSubscription'], [
            $this->pluck('subscription', $args),
            $args
        ]);
    }

    /**
     * @param array $args
     */
    public function modifyPushConfig(array $args)
    {
        return $this->send([$this->subscriberClient, 'modifyPushConfig'], [
            $this->pluck('subscription', $args),
            $this->buildPushConfig($this->pluck('pushConfig', $args)),
            $args
        ]);
    }

    /**
     * @param array $args
     */
    public function pull(array $args)
    {
        return $this->send([$this->subscriberClient, 'pull'], [
            $this->pluck('subscription', $args),
            $this->pluck('maxMessages', $args),
            $args
        ]);
    }

    /**
     * @param array $args
     */
    public function modifyAckDeadline(array $args)
    {
        return $this->send([$this->subscriberClient, 'modifyAckDeadline'], [
            $this->pluck('subscription', $args),
            $this->pluck('ackIds', $args),
            $this->pluck('ackDeadlineSeconds', $args),
            $args
        ]);
    }

    /**
     * @param array $args
     */
    public function acknowledge(array $args)
    {
        return $this->send([$this->subscriberClient, 'acknowledge'], [
            $this->pluck('subscription', $args),
            $this->pluck('ackIds', $args),
            $args
        ]);
    }

    /**
     * @param array $args
     */
    public function listSnapshots(array $args)
    {
        $whitelisted = true;
        return $this->send([$this->subscriberClient, 'listSnapshots'], [
            $this->pluck('project', $args),
            $args
        ], $whitelisted);
    }

    /**
     * @param array $args
     */
    public function createSnapshot(array $args)
    {
        $whitelisted = true;
        return $this->send([$this->subscriberClient, 'createSnapshot'], [
            $this->pluck('name', $args),
            $this->pluck('subscription', $args),
            $args
        ], $whitelisted);
    }

    /**
     * @param array $args
     */
    public function deleteSnapshot(array $args)
    {
        $whitelisted = true;
        return $this->send([$this->subscriberClient, 'deleteSnapshot'], [
            $this->pluck('snapshot', $args),
            $args
        ], $whitelisted);
    }

    /**
     * @param array $args
     */
    public function seek(array $args)
    {
        if (isset($args['time'])) {
            $time = $this->formatTimestampForApi($args['time']);
            $args['time'] = (new protobuf\Timestamp)->deserialize($time, $this->codec);
        }

        $whitelisted = true;
        return $this->send([$this->subscriberClient, 'seek'], [
            $this->pluck('subscription', $args),
            $args
        ], $whitelisted);
    }

    /**
     * @param array $args
     */
    public function getTopicIamPolicy(array $args)
    {
        return $this->send([$this->publisherClient, 'getIamPolicy'], [
            $this->pluck('resource', $args),
            $args
        ]);
    }

    /**
     * @param array $args
     */
    public function setTopicIamPolicy(array $args)
    {
        return $this->send([$this->publisherClient, 'setIamPolicy'], [
            $this->pluck('resource', $args),
            $this->buildPolicy($this->pluck('policy', $args)),
            $args
        ]);
    }

    /**
     * @param array $args
     */
    public function testTopicIamPermissions(array $args)
    {
        return $this->send([$this->publisherClient, 'testIamPermissions'], [
            $this->pluck('resource', $args),
            $this->pluck('permissions', $args),
            $args
        ]);
    }

    /**
     * @param array $args
     */
    public function getSubscriptionIamPolicy(array $args)
    {
        return $this->send([$this->subscriberClient, 'getIamPolicy'], [
            $this->pluck('resource', $args),
            $args
        ]);
    }

    /**
     * @param array $args
     */
    public function setSubscriptionIamPolicy(array $args)
    {
        return $this->send([$this->subscriberClient, 'setIamPolicy'], [
            $this->pluck('resource', $args),
            $this->buildPolicy($this->pluck('policy', $args)),
            $args
        ]);
    }

    /**
     * @param array $args
     */
    public function testSubscriptionIamPermissions(array $args)
    {
        return $this->send([$this->subscriberClient, 'testIamPermissions'], [
            $this->pluck('resource', $args),
            $this->pluck('permissions', $args),
            $args
        ]);
    }

    /**
     * @param array $message
     * @return PubsubMessage
     */
    private function buildMessage(array $message)
    {
        if (isset($message['attributes'])) {
            $message['attributes'] = $this->formatLabelsForApi($message['attributes']);
        }

        return (new PubsubMessage())->deserialize($message, $this->codec);
    }

    /**
     * @param array $policy
     * @return Policy
     */
    private function buildPolicy(array $policy)
    {
        return (new Policy())->deserialize($policy, $this->codec);
    }

    /**
     * @param array $pushConfig
     * @return PushConfig
     */
    private function buildPushConfig(array $pushConfig)
    {
        if (isset($pushConfig['attributes'])) {
            $pushConfig['attributes'] = $this->formatLabelsForApi($pushConfig['attributes']);
        }

        return (new PushConfig())->deserialize($pushConfig, $this->codec);
    }

    /**
     * Create a Subscription proto message from an array of arguments.
     *
     * @param array $args
     * @param bool $required
     * @return Subscription
     */
    private function buildSubscription(array &$args, $required = false)
    {
        $pushConfig = $this->pluck('pushConfig', $args, $required);
        $pushConfig = $pushConfig
            ? $this->buildPushConfig($pushConfig)
            : null;

        return (new Subscription())->deserialize(array_filter([
            'name' => $this->pluck('name', $args, $required),
            'topic' => $this->pluck('topic', $args, $required),
            'pushConfig' => $pushConfig,
            'ackDeadlineSeconds' => $this->pluck('ackDeadlineSeconds', $args, $required),
            'retainAckedMessages' => $this->pluck('retainAckedMessages', $args, $required),
            'messageRetentionDuration' => $this->pluck('messageRetentionDuration', $args, $required),
        ]), $this->codec);
    }
}
