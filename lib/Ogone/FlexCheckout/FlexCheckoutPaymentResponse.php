<?php

namespace Ogone\FlexCheckout;

use Ogone\AbstractPaymentResponse;
use Ogone\ShaComposer\ShaComposer;
use InvalidArgumentException;

class FlexCheckoutPaymentResponse extends AbstractPaymentResponse
{
    /**
     * @var int
     */
    const STATUS_OK = 0;
    /**
     * @var int
     */
    const STATUS_NOK = 1;
    /**
     * @var int
     */
    const STATUS_ALIAS_UPDATED = 2;
    /**
     * @var int
     */
    const STATUS_ALIAS_CANCELLED = 3;

    const PARAM_ALIAS_ALIASID = "ALIAS_ALIASID";

    const PARAM_ALIAS_ORDERID = "ALIAS_ORDERID";

    const PARAM_ALIAS_STATUS = "ALIAS_STATUS";

    const PARAM_ALIAS_NCERROR = "ALIAS_NCERROR";

    const PARAM_ALIAS_NCERRORCARDNO = "ALIAS_NCERRORCARDNO";

    const PARAM_ALIAS_NCERRORCN = "ALIAS_NCERRORCN";

    const PARAM_ALIAS_NCERRORCVC = "ALIAS_NCERRORCVC";

    const PARAM_ALIAS_NCERRORED = "ALIAS_NCERRORED";

    protected array $ogoneFields = ['ALIAS_ALIASID', 'CARD_BIN', 'CARD_BRAND', 'CARD_CARDNUMBER', 'CARD_CARDHOLDERNAME', 'CARD_CVC', 'CARD_EXPIRYDATE', 'ALIAS_NCERROR', 'ALIAS_NCERRORCARDNO', 'ALIAS_NCERRORCN', 'ALIAS_NCERRORCVC', 'ALIAS_NCERRORED', 'ALIAS_ORDERID', 'ALIAS_STATUS'];

    /**
     * Checks if the response is valid
     */
    public function isValid(ShaComposer $shaComposer): bool
    {
        return $shaComposer->compose($this->parameters) == $this->shaSign;
    }

    public function isSuccessful(): bool
    {
        return in_array($this->getParam(static::PARAM_ALIAS_STATUS),
            [static::STATUS_OK, static::STATUS_ALIAS_UPDATED]);
    }
}