<?php

namespace Ogone\Subscription;

use InvalidArgumentException;

class SubscriptionPeriod
{

    /** @var string */
    const UNIT_DAILY = 'd';

    /** @var string */
    const UNIT_WEEKLY = 'ww';

    /** @var string */
    const UNIT_MONTHLY = 'm';

    /**
     * @var string
     * ‘d’ = daily, ‘ww’ = weekly, ‘m’ = monthly
     */
    protected string $unit;

    /**
     * @var int
     * Interval between each occurrence of the subscription payments
     */
    protected int $interval;

    /**
     * @var int
     * Depending on sub_period_unit
     * Daily (d):
     *      interval in days
     * Weekly (ww):
     *      1=Sunday, … 7=Saturday
     * Monthly (m):
     *      day of the month
     */
    protected int $moment;

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(string $unit, int $interval, int $moment)
    {
        $this->setUnit($unit);
        $this->setInterval($interval);
        $this->setMoment($moment);
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setUnit(string $unit): void
    {
        if (!in_array($unit, [self::UNIT_DAILY, self::UNIT_WEEKLY, self::UNIT_MONTHLY])) {
            throw new InvalidArgumentException("Subscription period unit should be '".self::UNIT_DAILY."' (daily), '".self::UNIT_WEEKLY."' (weekly) or '".self::UNIT_MONTHLY."' (monthly)");
        }

        if (self::UNIT_WEEKLY === $unit) {
            if ($this->moment > 7) {
                throw new InvalidArgumentException('The unit cannot be set to weekly while the moment > 7');
            }
        } elseif (self::UNIT_MONTHLY === $unit && $this->moment > 28) {
            throw new InvalidArgumentException('The unit cannot be set to monthly while the moment > 28');
        }
        $this->unit = $unit;
    }

    public function getInterval(): int
    {
        return $this->interval;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setInterval(int $interval): void
    {
        if ($interval < 0) {
            throw new InvalidArgumentException("Interval must be a positive number > 0");
        }
        if ($interval >= 1.0E+15) {
            throw new InvalidArgumentException("Interval is too high");
        }
        $this->interval = $interval;
    }

    public function getMoment(): int
    {
        return $this->moment;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setMoment(int $moment): void
    {
        if ($moment <= 0) {
            throw new InvalidArgumentException("Moment must be a positive number");
        }
        if ($moment >= 1.0E+15) {
            throw new InvalidArgumentException("Interval is too high");
        }

        if (self::UNIT_WEEKLY == $this->unit) {
            // Valid values are 1 to 7
            if ($moment > 7) {
                throw new InvalidArgumentException("Moment should be 1 (Sunday), 2, 3 .. 7 (Saturday)");
            }
        } elseif (self::UNIT_MONTHLY == $this->unit && $moment > 28) {
            // We will not allow a day of month > 28
            throw new InvalidArgumentException("Moment can't be larger than 29. Last day for month allowed is 28.");
        }

        $this->moment = $moment;
    }
}
