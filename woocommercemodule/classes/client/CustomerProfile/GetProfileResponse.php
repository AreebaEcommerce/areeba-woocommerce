<?php

namespace WoocommerceModule\Client\CustomerProfile;

use WoocommerceModule\Client\Json\ResponseObject;

/**
 * Class GetProfileResponse
 *
 * @package WoocommerceModule\Client\CustomerProfile
 *
 * @property bool $profileExists
 * @property string $profileGuid
 * @property string $customerIdentification
 * @property string $preferredMethod
 * @property CustomerData $customer
 * @property PaymentInstrument[] $paymentInstruments
 */
class GetProfileResponse extends ResponseObject {

}
