<?php

/*
 * This file is part of the Marlon Ogone package.
 *
 * (c) Marlon BVBA <info@marlon.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ogone\ShaComposer;

use Ogone\HashAlgorithm;
use Ogone\Passphrase;

/**
 * SHA string composition the "old way", using only the "main" parameters
 * @deprecated Use AllParametersShaComposer wherever possible
 */
class LegacyShaComposer implements ShaComposer
{
    /**
     * @var HashAlgorithm
     */
    private HashAlgorithm $hashAlgorithm;

    /**
     * @param HashAlgorithm|null $hashAlgorithm
     */
    public function __construct(private readonly Passphrase $passphrase, HashAlgorithm $hashAlgorithm = null)
    {
        $this->hashAlgorithm = $hashAlgorithm ?: new HashAlgorithm(HashAlgorithm::HASH_SHA1);
    }

    public function compose(array $parameters, bool $useLatinCharset = false): string
    {
        $parameters = array_change_key_case($parameters);

        return strtoupper(hash($this->hashAlgorithm, implode('', [$parameters['orderid'], $parameters['currency'], $parameters['amount'], $parameters['pm'], $parameters['acceptance'], $parameters['status'], $parameters['cardno'], $parameters['payid'], $parameters['ncerror'], $parameters['brand'], $this->passphrase])));
    }
}
