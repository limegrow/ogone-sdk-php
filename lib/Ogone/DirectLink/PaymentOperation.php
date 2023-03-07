<?php
namespace Ogone\DirectLink;


class PaymentOperation implements \Stringable
{
    const REQUEST_FOR_AUTHORISATION = 'RES';
    const REQUEST_FOR_DIRECT_SALE = 'SAL';
    const REFUND = 'RFD';
    const REQUEST_FOR_PRE_AUTHORISATION = 'PAU';

    protected string $operation;

    public function __construct(string $operation)
    {
        if(!in_array($operation, self::getAllAvailableOperations())) {
            throw new \InvalidArgumentException('Unknown Operation: ' . $operation);
        }

        $this->operation = $operation;
    }

    public function equals(PaymentOperation $other): bool
    {
        return $this->operation === $other->operation;
    }

    public function __toString(): string
    {
        return $this->operation;
    }

    public function getAllAvailableOperations(): array
    {
        return [self::REQUEST_FOR_AUTHORISATION, self::REQUEST_FOR_DIRECT_SALE, self::REFUND, self::REQUEST_FOR_PRE_AUTHORISATION];
    }
} 