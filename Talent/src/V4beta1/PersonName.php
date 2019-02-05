<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/talent/v4beta1/profile.proto

namespace Google\Cloud\Talent\V4beta1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Resource that represents the name of a person.
 *
 * Generated from protobuf message <code>google.cloud.talent.v4beta1.PersonName</code>
 */
class PersonName extends \Google\Protobuf\Internal\Message
{
    /**
     * Optional.
     * Preferred name for the person.
     *
     * Generated from protobuf field <code>string preferred_name = 3;</code>
     */
    private $preferred_name = '';
    protected $person_name;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $formatted_name
     *           Optional.
     *           A string represents a person's full name. For example, "Dr. John Smith".
     *           Number of characters allowed is 100.
     *     @type \Google\Cloud\Talent\V4beta1\PersonName\PersonStructuredName $structured_name
     *           Optional.
     *           A person's name in a structured way (last name, first name, suffix, etc.)
     *     @type string $preferred_name
     *           Optional.
     *           Preferred name for the person.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Talent\V4Beta1\Profile::initOnce();
        parent::__construct($data);
    }

    /**
     * Optional.
     * A string represents a person's full name. For example, "Dr. John Smith".
     * Number of characters allowed is 100.
     *
     * Generated from protobuf field <code>string formatted_name = 1;</code>
     * @return string
     */
    public function getFormattedName()
    {
        return $this->readOneof(1);
    }

    /**
     * Optional.
     * A string represents a person's full name. For example, "Dr. John Smith".
     * Number of characters allowed is 100.
     *
     * Generated from protobuf field <code>string formatted_name = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setFormattedName($var)
    {
        GPBUtil::checkString($var, True);
        $this->writeOneof(1, $var);

        return $this;
    }

    /**
     * Optional.
     * A person's name in a structured way (last name, first name, suffix, etc.)
     *
     * Generated from protobuf field <code>.google.cloud.talent.v4beta1.PersonName.PersonStructuredName structured_name = 2;</code>
     * @return \Google\Cloud\Talent\V4beta1\PersonName\PersonStructuredName
     */
    public function getStructuredName()
    {
        return $this->readOneof(2);
    }

    /**
     * Optional.
     * A person's name in a structured way (last name, first name, suffix, etc.)
     *
     * Generated from protobuf field <code>.google.cloud.talent.v4beta1.PersonName.PersonStructuredName structured_name = 2;</code>
     * @param \Google\Cloud\Talent\V4beta1\PersonName\PersonStructuredName $var
     * @return $this
     */
    public function setStructuredName($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Talent\V4beta1\PersonName_PersonStructuredName::class);
        $this->writeOneof(2, $var);

        return $this;
    }

    /**
     * Optional.
     * Preferred name for the person.
     *
     * Generated from protobuf field <code>string preferred_name = 3;</code>
     * @return string
     */
    public function getPreferredName()
    {
        return $this->preferred_name;
    }

    /**
     * Optional.
     * Preferred name for the person.
     *
     * Generated from protobuf field <code>string preferred_name = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setPreferredName($var)
    {
        GPBUtil::checkString($var, True);
        $this->preferred_name = $var;

        return $this;
    }

    /**
     * @return string
     */
    public function getPersonName()
    {
        return $this->whichOneof("person_name");
    }

}

