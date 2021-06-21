<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/lifesciences/v2beta/workflows.proto

namespace Google\Cloud\LifeSciences\V2beta;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Carries information about the pipeline execution that is returned
 * in the long running operation's metadata field.
 *
 * Generated from protobuf message <code>google.cloud.lifesciences.v2beta.Metadata</code>
 */
class Metadata extends \Google\Protobuf\Internal\Message
{
    /**
     * The pipeline this operation represents.
     *
     * Generated from protobuf field <code>.google.cloud.lifesciences.v2beta.Pipeline pipeline = 1;</code>
     */
    private $pipeline = null;
    /**
     * The user-defined labels associated with this operation.
     *
     * Generated from protobuf field <code>map<string, string> labels = 2;</code>
     */
    private $labels;
    /**
     * The list of events that have happened so far during the execution of this
     * operation.
     *
     * Generated from protobuf field <code>repeated .google.cloud.lifesciences.v2beta.Event events = 3;</code>
     */
    private $events;
    /**
     * The time at which the operation was created by the API.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp create_time = 4;</code>
     */
    private $create_time = null;
    /**
     * The first time at which resources were allocated to execute the pipeline.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp start_time = 5;</code>
     */
    private $start_time = null;
    /**
     * The time at which execution was completed and resources were cleaned up.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp end_time = 6;</code>
     */
    private $end_time = null;
    /**
     * The name of the Cloud Pub/Sub topic where notifications of operation status
     * changes are sent.
     *
     * Generated from protobuf field <code>string pub_sub_topic = 7;</code>
     */
    private $pub_sub_topic = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Cloud\LifeSciences\V2beta\Pipeline $pipeline
     *           The pipeline this operation represents.
     *     @type array|\Google\Protobuf\Internal\MapField $labels
     *           The user-defined labels associated with this operation.
     *     @type \Google\Cloud\LifeSciences\V2beta\Event[]|\Google\Protobuf\Internal\RepeatedField $events
     *           The list of events that have happened so far during the execution of this
     *           operation.
     *     @type \Google\Protobuf\Timestamp $create_time
     *           The time at which the operation was created by the API.
     *     @type \Google\Protobuf\Timestamp $start_time
     *           The first time at which resources were allocated to execute the pipeline.
     *     @type \Google\Protobuf\Timestamp $end_time
     *           The time at which execution was completed and resources were cleaned up.
     *     @type string $pub_sub_topic
     *           The name of the Cloud Pub/Sub topic where notifications of operation status
     *           changes are sent.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Lifesciences\V2Beta\Workflows::initOnce();
        parent::__construct($data);
    }

    /**
     * The pipeline this operation represents.
     *
     * Generated from protobuf field <code>.google.cloud.lifesciences.v2beta.Pipeline pipeline = 1;</code>
     * @return \Google\Cloud\LifeSciences\V2beta\Pipeline|null
     */
    public function getPipeline()
    {
        return isset($this->pipeline) ? $this->pipeline : null;
    }

    public function hasPipeline()
    {
        return isset($this->pipeline);
    }

    public function clearPipeline()
    {
        unset($this->pipeline);
    }

    /**
     * The pipeline this operation represents.
     *
     * Generated from protobuf field <code>.google.cloud.lifesciences.v2beta.Pipeline pipeline = 1;</code>
     * @param \Google\Cloud\LifeSciences\V2beta\Pipeline $var
     * @return $this
     */
    public function setPipeline($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\LifeSciences\V2beta\Pipeline::class);
        $this->pipeline = $var;

        return $this;
    }

    /**
     * The user-defined labels associated with this operation.
     *
     * Generated from protobuf field <code>map<string, string> labels = 2;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getLabels()
    {
        return $this->labels;
    }

    /**
     * The user-defined labels associated with this operation.
     *
     * Generated from protobuf field <code>map<string, string> labels = 2;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setLabels($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::STRING, \Google\Protobuf\Internal\GPBType::STRING);
        $this->labels = $arr;

        return $this;
    }

    /**
     * The list of events that have happened so far during the execution of this
     * operation.
     *
     * Generated from protobuf field <code>repeated .google.cloud.lifesciences.v2beta.Event events = 3;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * The list of events that have happened so far during the execution of this
     * operation.
     *
     * Generated from protobuf field <code>repeated .google.cloud.lifesciences.v2beta.Event events = 3;</code>
     * @param \Google\Cloud\LifeSciences\V2beta\Event[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setEvents($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Cloud\LifeSciences\V2beta\Event::class);
        $this->events = $arr;

        return $this;
    }

    /**
     * The time at which the operation was created by the API.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp create_time = 4;</code>
     * @return \Google\Protobuf\Timestamp|null
     */
    public function getCreateTime()
    {
        return isset($this->create_time) ? $this->create_time : null;
    }

    public function hasCreateTime()
    {
        return isset($this->create_time);
    }

    public function clearCreateTime()
    {
        unset($this->create_time);
    }

    /**
     * The time at which the operation was created by the API.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp create_time = 4;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setCreateTime($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->create_time = $var;

        return $this;
    }

    /**
     * The first time at which resources were allocated to execute the pipeline.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp start_time = 5;</code>
     * @return \Google\Protobuf\Timestamp|null
     */
    public function getStartTime()
    {
        return isset($this->start_time) ? $this->start_time : null;
    }

    public function hasStartTime()
    {
        return isset($this->start_time);
    }

    public function clearStartTime()
    {
        unset($this->start_time);
    }

    /**
     * The first time at which resources were allocated to execute the pipeline.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp start_time = 5;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setStartTime($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->start_time = $var;

        return $this;
    }

    /**
     * The time at which execution was completed and resources were cleaned up.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp end_time = 6;</code>
     * @return \Google\Protobuf\Timestamp|null
     */
    public function getEndTime()
    {
        return isset($this->end_time) ? $this->end_time : null;
    }

    public function hasEndTime()
    {
        return isset($this->end_time);
    }

    public function clearEndTime()
    {
        unset($this->end_time);
    }

    /**
     * The time at which execution was completed and resources were cleaned up.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp end_time = 6;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setEndTime($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->end_time = $var;

        return $this;
    }

    /**
     * The name of the Cloud Pub/Sub topic where notifications of operation status
     * changes are sent.
     *
     * Generated from protobuf field <code>string pub_sub_topic = 7;</code>
     * @return string
     */
    public function getPubSubTopic()
    {
        return $this->pub_sub_topic;
    }

    /**
     * The name of the Cloud Pub/Sub topic where notifications of operation status
     * changes are sent.
     *
     * Generated from protobuf field <code>string pub_sub_topic = 7;</code>
     * @param string $var
     * @return $this
     */
    public function setPubSubTopic($var)
    {
        GPBUtil::checkString($var, True);
        $this->pub_sub_topic = $var;

        return $this;
    }

}

