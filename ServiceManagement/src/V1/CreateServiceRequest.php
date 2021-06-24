<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/api/servicemanagement/v1/servicemanager.proto

namespace Google\Cloud\ServiceManagement\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Request message for CreateService method.
 *
 * Generated from protobuf message <code>google.api.servicemanagement.v1.CreateServiceRequest</code>
 */
class CreateServiceRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. Initial values for the service resource.
     *
     * Generated from protobuf field <code>.google.api.servicemanagement.v1.ManagedService service = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $service = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Cloud\ServiceManagement\V1\ManagedService $service
     *           Required. Initial values for the service resource.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Api\Servicemanagement\V1\Servicemanager::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. Initial values for the service resource.
     *
     * Generated from protobuf field <code>.google.api.servicemanagement.v1.ManagedService service = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return \Google\Cloud\ServiceManagement\V1\ManagedService|null
     */
    public function getService()
    {
        return isset($this->service) ? $this->service : null;
    }

    public function hasService()
    {
        return isset($this->service);
    }

    public function clearService()
    {
        unset($this->service);
    }

    /**
     * Required. Initial values for the service resource.
     *
     * Generated from protobuf field <code>.google.api.servicemanagement.v1.ManagedService service = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param \Google\Cloud\ServiceManagement\V1\ManagedService $var
     * @return $this
     */
    public function setService($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\ServiceManagement\V1\ManagedService::class);
        $this->service = $var;

        return $this;
    }

}

