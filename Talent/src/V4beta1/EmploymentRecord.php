<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/talent/v4beta1/profile.proto

namespace Google\Cloud\Talent\V4beta1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Resource that represents an employment record of a candidate.
 *
 * Generated from protobuf message <code>google.cloud.talent.v4beta1.EmploymentRecord</code>
 */
class EmploymentRecord extends \Google\Protobuf\Internal\Message
{
    /**
     * Optional.
     * Start date of the employment.
     *
     * Generated from protobuf field <code>.google.type.Date start_date = 1;</code>
     */
    private $start_date = null;
    /**
     * Optional.
     * End date of the employment.
     *
     * Generated from protobuf field <code>.google.type.Date end_date = 2;</code>
     */
    private $end_date = null;
    /**
     * Optional.
     * The name of the employer company/organization.
     * For example, "Google", "Alphabet", and so on.
     * Number of characters allowed is 100.
     *
     * Generated from protobuf field <code>string employer_name = 3;</code>
     */
    private $employer_name = '';
    /**
     * Optional.
     * The division name of the employment.
     * For example, division, department, client, and so on.
     * Number of characters allowed is 100.
     *
     * Generated from protobuf field <code>string division_name = 4;</code>
     */
    private $division_name = '';
    /**
     * Optional.
     * The physical address of the employer.
     *
     * Generated from protobuf field <code>.google.cloud.talent.v4beta1.Address address = 5;</code>
     */
    private $address = null;
    /**
     * Optional.
     * The job title of the employment.
     * For example, "Software Engineer", "Data Scientist", and so on.
     * Number of characters allowed is 100.
     *
     * Generated from protobuf field <code>string job_title = 6;</code>
     */
    private $job_title = '';
    /**
     * Optional.
     * The description of job content.
     * Number of characters allowed is 100,000.
     *
     * Generated from protobuf field <code>string job_description = 7;</code>
     */
    private $job_description = '';
    /**
     * Optional.
     * If the jobs is a supervisor position.
     *
     * Generated from protobuf field <code>.google.protobuf.BoolValue is_supervisor = 8;</code>
     */
    private $is_supervisor = null;
    /**
     * Optional.
     * If this employment is self-employed.
     *
     * Generated from protobuf field <code>.google.protobuf.BoolValue is_self_employed = 9;</code>
     */
    private $is_self_employed = null;
    /**
     * Optional.
     * If this employment is current.
     *
     * Generated from protobuf field <code>.google.protobuf.BoolValue is_current = 10;</code>
     */
    private $is_current = null;
    /**
     * Output only. The job title snippet shows how the [job_title][google.cloud.talent.v4beta1.EmploymentRecord.job_title] is related
     * to a search query. It's empty if the [job_title][google.cloud.talent.v4beta1.EmploymentRecord.job_title] isn't related to the
     * search query.
     *
     * Generated from protobuf field <code>string job_title_snippet = 11;</code>
     */
    private $job_title_snippet = '';
    /**
     * Output only. The job description snippet shows how the [job_description][google.cloud.talent.v4beta1.EmploymentRecord.job_description]
     * is related to a search query. It's empty if the [job_description][google.cloud.talent.v4beta1.EmploymentRecord.job_description] isn't
     * related to the search query.
     *
     * Generated from protobuf field <code>string job_description_snippet = 12;</code>
     */
    private $job_description_snippet = '';
    /**
     * Output only. The employer name snippet shows how the [employer_name][google.cloud.talent.v4beta1.EmploymentRecord.employer_name] is
     * related to a search query. It's empty if the [employer_name][google.cloud.talent.v4beta1.EmploymentRecord.employer_name] isn't
     * related to the search query.
     *
     * Generated from protobuf field <code>string employer_name_snippet = 13;</code>
     */
    private $employer_name_snippet = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Type\Date $start_date
     *           Optional.
     *           Start date of the employment.
     *     @type \Google\Type\Date $end_date
     *           Optional.
     *           End date of the employment.
     *     @type string $employer_name
     *           Optional.
     *           The name of the employer company/organization.
     *           For example, "Google", "Alphabet", and so on.
     *           Number of characters allowed is 100.
     *     @type string $division_name
     *           Optional.
     *           The division name of the employment.
     *           For example, division, department, client, and so on.
     *           Number of characters allowed is 100.
     *     @type \Google\Cloud\Talent\V4beta1\Address $address
     *           Optional.
     *           The physical address of the employer.
     *     @type string $job_title
     *           Optional.
     *           The job title of the employment.
     *           For example, "Software Engineer", "Data Scientist", and so on.
     *           Number of characters allowed is 100.
     *     @type string $job_description
     *           Optional.
     *           The description of job content.
     *           Number of characters allowed is 100,000.
     *     @type \Google\Protobuf\BoolValue $is_supervisor
     *           Optional.
     *           If the jobs is a supervisor position.
     *     @type \Google\Protobuf\BoolValue $is_self_employed
     *           Optional.
     *           If this employment is self-employed.
     *     @type \Google\Protobuf\BoolValue $is_current
     *           Optional.
     *           If this employment is current.
     *     @type string $job_title_snippet
     *           Output only. The job title snippet shows how the [job_title][google.cloud.talent.v4beta1.EmploymentRecord.job_title] is related
     *           to a search query. It's empty if the [job_title][google.cloud.talent.v4beta1.EmploymentRecord.job_title] isn't related to the
     *           search query.
     *     @type string $job_description_snippet
     *           Output only. The job description snippet shows how the [job_description][google.cloud.talent.v4beta1.EmploymentRecord.job_description]
     *           is related to a search query. It's empty if the [job_description][google.cloud.talent.v4beta1.EmploymentRecord.job_description] isn't
     *           related to the search query.
     *     @type string $employer_name_snippet
     *           Output only. The employer name snippet shows how the [employer_name][google.cloud.talent.v4beta1.EmploymentRecord.employer_name] is
     *           related to a search query. It's empty if the [employer_name][google.cloud.talent.v4beta1.EmploymentRecord.employer_name] isn't
     *           related to the search query.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Talent\V4Beta1\Profile::initOnce();
        parent::__construct($data);
    }

    /**
     * Optional.
     * Start date of the employment.
     *
     * Generated from protobuf field <code>.google.type.Date start_date = 1;</code>
     * @return \Google\Type\Date
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * Optional.
     * Start date of the employment.
     *
     * Generated from protobuf field <code>.google.type.Date start_date = 1;</code>
     * @param \Google\Type\Date $var
     * @return $this
     */
    public function setStartDate($var)
    {
        GPBUtil::checkMessage($var, \Google\Type\Date::class);
        $this->start_date = $var;

        return $this;
    }

    /**
     * Optional.
     * End date of the employment.
     *
     * Generated from protobuf field <code>.google.type.Date end_date = 2;</code>
     * @return \Google\Type\Date
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * Optional.
     * End date of the employment.
     *
     * Generated from protobuf field <code>.google.type.Date end_date = 2;</code>
     * @param \Google\Type\Date $var
     * @return $this
     */
    public function setEndDate($var)
    {
        GPBUtil::checkMessage($var, \Google\Type\Date::class);
        $this->end_date = $var;

        return $this;
    }

    /**
     * Optional.
     * The name of the employer company/organization.
     * For example, "Google", "Alphabet", and so on.
     * Number of characters allowed is 100.
     *
     * Generated from protobuf field <code>string employer_name = 3;</code>
     * @return string
     */
    public function getEmployerName()
    {
        return $this->employer_name;
    }

    /**
     * Optional.
     * The name of the employer company/organization.
     * For example, "Google", "Alphabet", and so on.
     * Number of characters allowed is 100.
     *
     * Generated from protobuf field <code>string employer_name = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setEmployerName($var)
    {
        GPBUtil::checkString($var, True);
        $this->employer_name = $var;

        return $this;
    }

    /**
     * Optional.
     * The division name of the employment.
     * For example, division, department, client, and so on.
     * Number of characters allowed is 100.
     *
     * Generated from protobuf field <code>string division_name = 4;</code>
     * @return string
     */
    public function getDivisionName()
    {
        return $this->division_name;
    }

    /**
     * Optional.
     * The division name of the employment.
     * For example, division, department, client, and so on.
     * Number of characters allowed is 100.
     *
     * Generated from protobuf field <code>string division_name = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setDivisionName($var)
    {
        GPBUtil::checkString($var, True);
        $this->division_name = $var;

        return $this;
    }

    /**
     * Optional.
     * The physical address of the employer.
     *
     * Generated from protobuf field <code>.google.cloud.talent.v4beta1.Address address = 5;</code>
     * @return \Google\Cloud\Talent\V4beta1\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Optional.
     * The physical address of the employer.
     *
     * Generated from protobuf field <code>.google.cloud.talent.v4beta1.Address address = 5;</code>
     * @param \Google\Cloud\Talent\V4beta1\Address $var
     * @return $this
     */
    public function setAddress($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Talent\V4beta1\Address::class);
        $this->address = $var;

        return $this;
    }

    /**
     * Optional.
     * The job title of the employment.
     * For example, "Software Engineer", "Data Scientist", and so on.
     * Number of characters allowed is 100.
     *
     * Generated from protobuf field <code>string job_title = 6;</code>
     * @return string
     */
    public function getJobTitle()
    {
        return $this->job_title;
    }

    /**
     * Optional.
     * The job title of the employment.
     * For example, "Software Engineer", "Data Scientist", and so on.
     * Number of characters allowed is 100.
     *
     * Generated from protobuf field <code>string job_title = 6;</code>
     * @param string $var
     * @return $this
     */
    public function setJobTitle($var)
    {
        GPBUtil::checkString($var, True);
        $this->job_title = $var;

        return $this;
    }

    /**
     * Optional.
     * The description of job content.
     * Number of characters allowed is 100,000.
     *
     * Generated from protobuf field <code>string job_description = 7;</code>
     * @return string
     */
    public function getJobDescription()
    {
        return $this->job_description;
    }

    /**
     * Optional.
     * The description of job content.
     * Number of characters allowed is 100,000.
     *
     * Generated from protobuf field <code>string job_description = 7;</code>
     * @param string $var
     * @return $this
     */
    public function setJobDescription($var)
    {
        GPBUtil::checkString($var, True);
        $this->job_description = $var;

        return $this;
    }

    /**
     * Optional.
     * If the jobs is a supervisor position.
     *
     * Generated from protobuf field <code>.google.protobuf.BoolValue is_supervisor = 8;</code>
     * @return \Google\Protobuf\BoolValue
     */
    public function getIsSupervisor()
    {
        return $this->is_supervisor;
    }

    /**
     * Returns the unboxed value from <code>getIsSupervisor()</code>

     * Optional.
     * If the jobs is a supervisor position.
     *
     * Generated from protobuf field <code>.google.protobuf.BoolValue is_supervisor = 8;</code>
     * @return bool|null
     */
    public function getIsSupervisorValue()
    {
        $wrapper = $this->getIsSupervisor();
        return is_null($wrapper) ? null : $wrapper->getValue();
    }

    /**
     * Optional.
     * If the jobs is a supervisor position.
     *
     * Generated from protobuf field <code>.google.protobuf.BoolValue is_supervisor = 8;</code>
     * @param \Google\Protobuf\BoolValue $var
     * @return $this
     */
    public function setIsSupervisor($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\BoolValue::class);
        $this->is_supervisor = $var;

        return $this;
    }

    /**
     * Sets the field by wrapping a primitive type in a Google\Protobuf\BoolValue object.

     * Optional.
     * If the jobs is a supervisor position.
     *
     * Generated from protobuf field <code>.google.protobuf.BoolValue is_supervisor = 8;</code>
     * @param bool|null $var
     * @return $this
     */
    public function setIsSupervisorValue($var)
    {
        $wrappedVar = is_null($var) ? null : new \Google\Protobuf\BoolValue(['value' => $var]);
        return $this->setIsSupervisor($wrappedVar);
    }

    /**
     * Optional.
     * If this employment is self-employed.
     *
     * Generated from protobuf field <code>.google.protobuf.BoolValue is_self_employed = 9;</code>
     * @return \Google\Protobuf\BoolValue
     */
    public function getIsSelfEmployed()
    {
        return $this->is_self_employed;
    }

    /**
     * Returns the unboxed value from <code>getIsSelfEmployed()</code>

     * Optional.
     * If this employment is self-employed.
     *
     * Generated from protobuf field <code>.google.protobuf.BoolValue is_self_employed = 9;</code>
     * @return bool|null
     */
    public function getIsSelfEmployedValue()
    {
        $wrapper = $this->getIsSelfEmployed();
        return is_null($wrapper) ? null : $wrapper->getValue();
    }

    /**
     * Optional.
     * If this employment is self-employed.
     *
     * Generated from protobuf field <code>.google.protobuf.BoolValue is_self_employed = 9;</code>
     * @param \Google\Protobuf\BoolValue $var
     * @return $this
     */
    public function setIsSelfEmployed($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\BoolValue::class);
        $this->is_self_employed = $var;

        return $this;
    }

    /**
     * Sets the field by wrapping a primitive type in a Google\Protobuf\BoolValue object.

     * Optional.
     * If this employment is self-employed.
     *
     * Generated from protobuf field <code>.google.protobuf.BoolValue is_self_employed = 9;</code>
     * @param bool|null $var
     * @return $this
     */
    public function setIsSelfEmployedValue($var)
    {
        $wrappedVar = is_null($var) ? null : new \Google\Protobuf\BoolValue(['value' => $var]);
        return $this->setIsSelfEmployed($wrappedVar);
    }

    /**
     * Optional.
     * If this employment is current.
     *
     * Generated from protobuf field <code>.google.protobuf.BoolValue is_current = 10;</code>
     * @return \Google\Protobuf\BoolValue
     */
    public function getIsCurrent()
    {
        return $this->is_current;
    }

    /**
     * Returns the unboxed value from <code>getIsCurrent()</code>

     * Optional.
     * If this employment is current.
     *
     * Generated from protobuf field <code>.google.protobuf.BoolValue is_current = 10;</code>
     * @return bool|null
     */
    public function getIsCurrentValue()
    {
        $wrapper = $this->getIsCurrent();
        return is_null($wrapper) ? null : $wrapper->getValue();
    }

    /**
     * Optional.
     * If this employment is current.
     *
     * Generated from protobuf field <code>.google.protobuf.BoolValue is_current = 10;</code>
     * @param \Google\Protobuf\BoolValue $var
     * @return $this
     */
    public function setIsCurrent($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\BoolValue::class);
        $this->is_current = $var;

        return $this;
    }

    /**
     * Sets the field by wrapping a primitive type in a Google\Protobuf\BoolValue object.

     * Optional.
     * If this employment is current.
     *
     * Generated from protobuf field <code>.google.protobuf.BoolValue is_current = 10;</code>
     * @param bool|null $var
     * @return $this
     */
    public function setIsCurrentValue($var)
    {
        $wrappedVar = is_null($var) ? null : new \Google\Protobuf\BoolValue(['value' => $var]);
        return $this->setIsCurrent($wrappedVar);
    }

    /**
     * Output only. The job title snippet shows how the [job_title][google.cloud.talent.v4beta1.EmploymentRecord.job_title] is related
     * to a search query. It's empty if the [job_title][google.cloud.talent.v4beta1.EmploymentRecord.job_title] isn't related to the
     * search query.
     *
     * Generated from protobuf field <code>string job_title_snippet = 11;</code>
     * @return string
     */
    public function getJobTitleSnippet()
    {
        return $this->job_title_snippet;
    }

    /**
     * Output only. The job title snippet shows how the [job_title][google.cloud.talent.v4beta1.EmploymentRecord.job_title] is related
     * to a search query. It's empty if the [job_title][google.cloud.talent.v4beta1.EmploymentRecord.job_title] isn't related to the
     * search query.
     *
     * Generated from protobuf field <code>string job_title_snippet = 11;</code>
     * @param string $var
     * @return $this
     */
    public function setJobTitleSnippet($var)
    {
        GPBUtil::checkString($var, True);
        $this->job_title_snippet = $var;

        return $this;
    }

    /**
     * Output only. The job description snippet shows how the [job_description][google.cloud.talent.v4beta1.EmploymentRecord.job_description]
     * is related to a search query. It's empty if the [job_description][google.cloud.talent.v4beta1.EmploymentRecord.job_description] isn't
     * related to the search query.
     *
     * Generated from protobuf field <code>string job_description_snippet = 12;</code>
     * @return string
     */
    public function getJobDescriptionSnippet()
    {
        return $this->job_description_snippet;
    }

    /**
     * Output only. The job description snippet shows how the [job_description][google.cloud.talent.v4beta1.EmploymentRecord.job_description]
     * is related to a search query. It's empty if the [job_description][google.cloud.talent.v4beta1.EmploymentRecord.job_description] isn't
     * related to the search query.
     *
     * Generated from protobuf field <code>string job_description_snippet = 12;</code>
     * @param string $var
     * @return $this
     */
    public function setJobDescriptionSnippet($var)
    {
        GPBUtil::checkString($var, True);
        $this->job_description_snippet = $var;

        return $this;
    }

    /**
     * Output only. The employer name snippet shows how the [employer_name][google.cloud.talent.v4beta1.EmploymentRecord.employer_name] is
     * related to a search query. It's empty if the [employer_name][google.cloud.talent.v4beta1.EmploymentRecord.employer_name] isn't
     * related to the search query.
     *
     * Generated from protobuf field <code>string employer_name_snippet = 13;</code>
     * @return string
     */
    public function getEmployerNameSnippet()
    {
        return $this->employer_name_snippet;
    }

    /**
     * Output only. The employer name snippet shows how the [employer_name][google.cloud.talent.v4beta1.EmploymentRecord.employer_name] is
     * related to a search query. It's empty if the [employer_name][google.cloud.talent.v4beta1.EmploymentRecord.employer_name] isn't
     * related to the search query.
     *
     * Generated from protobuf field <code>string employer_name_snippet = 13;</code>
     * @param string $var
     * @return $this
     */
    public function setEmployerNameSnippet($var)
    {
        GPBUtil::checkString($var, True);
        $this->employer_name_snippet = $var;

        return $this;
    }

}

