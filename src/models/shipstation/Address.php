<?php
/**
 * Shipstation Connect plugin for Craft CMS 4.x
 *
 * @link      https://fostercommerce.com
 */

namespace fostercommerce\shipstationconnect\models\shipstation;

/**
 * Class Address
 *
 * @package fostercommerce\shipstationconnect\models
 */
class Address extends \craft\base\Model
{
    /**
     * @var string Label of address.
     */
    public $label;

    /**
     * @var string First name of addressee.
     */
    public $firstName;

     /**
     * @var string Last name of addressee.
     */
    public $lastName;

    /**
     * @var string Full name of addressee.
     */
    public $fullName;

    /**
     * @var string|null Organization name.
     */
    public $organization;

    /**
     * @var string First line of address.
     */
    public $addressLine1;

    /**
     * @var string|null Second line of address.
     */
    public $addressLine2;

    /** 
     * @var string|null City
     */
    public $locality;

    /**
     * @var string|null State
     */
    public $administrativeArea;

    /**
     * @var string Postal code number.
     */
    public $postalCode;

    /**
     * @var string|null CountryCode
     */
    public $countryCode;

    /**
     * @var string|null Phone number.
     */
    public $phone;

    /**
     * @var array|null Custom address fields
     */
    public $customFields;

    /**
     * @var bool
     */
    public $hasMinimalRequiredInfo;

    /**
     * @return string|null
     */
    public function getFormattedPhone()
    {
        $num = $this->phone;

        if (strlen($num) === 10 && is_numeric($num)) {
            // format US phone numbers (555) 555-5555
            return ($num) ?
                '('.substr($num,0,3).') '.substr($num,3,3).'-'.substr($num,6,4)
                : '&nbsp;';
        }

        return $num;
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['label', 'fullName', 'organization', 'addressLine1', 'addressLine2', 'locality', 'countryCode', 'administrativeArea', 'postalCode', 'phone', 'email'], 'string', 'max' => 255],
            [['fullName', 'addressLine1', 'locality', 'countryCode', 'administrativeArea', 'postalCode'], 'required'],
            [['companyName', 'addressLine2', 'phone'], 'default', 'value' => null],
            [['countryCode'], 'default', 'value' => 'US'],
            [['countryCode', 'administrativeArea'], 'string', 'length' => 2],
        ];
    }

}
