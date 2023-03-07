<?php
/*
 * This file is part of the Marlon Ogone package.
 *
 * (c) Marlon BVBA <info@marlon.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ogone\DirectLink;

use Ogone\AbstractAlias;
use InvalidArgumentException;

class Alias extends AbstractAlias
{
    /** @var string */
    private string $cardName;

    /** @var string */
    private string $cardNumber;

    /** @var string */
    private string $expiryDate;

    /**
     * @param $alias
     * @param string|null $cardName
     * @param string|null $cardNumber
     * @param string|null $expiryDate
     */
    public function __construct($alias, string $cardName = null, string $cardNumber = null, string $expiryDate = null)
    {
        if (empty($alias)) {
            throw new InvalidArgumentException("Alias cannot be empty");
        }

        if (strlen((string) $alias) > 50) {
            throw new InvalidArgumentException("Alias is too long");
        }

        if (preg_match('/[^a-zA-Z0-9_-]/', (string) $alias)) {
            throw new InvalidArgumentException("Alias cannot contain special characters");
        }

        $this->setAlias($alias)
            ->setCardName($cardName)
            ->setCardNumber($cardNumber)
            ->setExpiryDate($expiryDate);
    }

    /**
     * Set Card Name
     *
     *
     * @return $this
     */
    public function setCardName(string $cardName): static
    {
        $this->cardName = $cardName;

        return $this;
    }

    /**
     * Get Card Name
     */
    public function getCardName(): ?string
    {
        return $this->cardName;
    }

    /**
     * Set Card Number
     *
     *
     * @return $this
     */
    public function setCardNumber(string $cardNumber): static
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    /**
     * Get Card Number
     */
    public function getCardNumber(): ?string
    {
        return $this->cardNumber;
    }

    /**
     * Set Expiry Date
     *
     * @return $this
     */
    public function setExpiryDate(string $expiryDate): static
    {
        $this->expiryDate = $expiryDate;

        return $this;
    }

    /**
     * Get Expiry Date
     */
    public function getExpiryDate(): ?string
    {
        return $this->expiryDate;
    }
}
