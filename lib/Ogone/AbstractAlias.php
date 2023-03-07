<?php

namespace Ogone;

abstract class AbstractAlias implements \Stringable
{
    const OPERATION_BY_MERCHANT = 'BYMERCHANT';
    const OPERATION_BY_PSP = 'BYPSP';

    /** @var string */
    protected string $aliasOperation;

    /** @var string */
    protected string $aliasUsage;

    /** @var string */
    protected string $alias;

    /**
     * Set Alias Name
     *
     * @return $this
     */
    public function setAlias(string $alias): static
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get Alias Name
     *
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * Set Alias Usage
     *
     * @return $this
     */
    public function setAliasUsage(string $aliasUsage): static
    {
        $this->aliasUsage = $aliasUsage;

        return $this;
    }

    /**
     * Get Alias Usage
     *
     * @return string
     */
    public function getAliasUsage(): string
    {
        return $this->aliasUsage;
    }

    /**
     * Set Alias Operation
     *
     * @return $this
     */
    public function setAliasOperation(string $aliasOperation): static
    {
        $this->aliasOperation = $aliasOperation;

        return $this;
    }

    /**
     * Get Alias Operation
     *
     * @return string
     */
    public function getAliasOperation(): string
    {
        return $this->aliasOperation;
    }

    /**
     * Set Alias Operation: By Merchant
     *
     * @return $this
     */
    public function operationByMerchant(): static
    {
        return $this->setAliasOperation(self::OPERATION_BY_MERCHANT);
    }

    /**
     * Set Alias Operation: By Psp
     *
     * @return $this
     */
    public function operationByPsp(): static
    {
        return $this->setAliasOperation(self::OPERATION_BY_PSP);
    }

    /**
     * To String
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->alias;
    }
}
