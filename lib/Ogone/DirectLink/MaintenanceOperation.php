<?php
namespace Ogone\DirectLink;


class MaintenanceOperation implements \Stringable
{
    const OPERATION_AUTHORISATION_RENEW = 'REN';
    const OPERATION_AUTHORISATION_DELETE = 'DEL';
    const OPERATION_AUTHORISATION_DELETE_AND_CLOSE = 'DES';
    const OPERATION_CAPTURE_PARTIAL = 'SAL';
    const OPERATION_CAPTURE_LAST_OR_FULL = 'SAS';
    const OPERATION_REFUND_PARTIAL = 'RFD';
    const OPERATION_REFUND_LAST_OR_FULL = 'RFS';

    protected string $operation;

    public function __construct(string $operation)
    {
        if(!in_array($operation, self::getAllAvailableOperations())) {
            throw new \InvalidArgumentException('Unknown Operation: ' . $operation);
        }

        $this->operation = $operation;
    }

    public function equals(MaintenanceOperation $other): bool
    {
        return $this->operation === $other->operation;
    }

    public function __toString(): string
    {
        return $this->operation;
    }

    private function getAllAvailableOperations(): array
    {
        return [self::OPERATION_AUTHORISATION_RENEW, self::OPERATION_AUTHORISATION_DELETE, self::OPERATION_AUTHORISATION_DELETE_AND_CLOSE, self::OPERATION_CAPTURE_PARTIAL, self::OPERATION_CAPTURE_LAST_OR_FULL, self::OPERATION_REFUND_PARTIAL, self::OPERATION_REFUND_LAST_OR_FULL];
    }
} 