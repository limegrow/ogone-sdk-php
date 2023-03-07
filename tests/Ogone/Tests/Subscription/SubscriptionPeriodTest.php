<?php

namespace Ogone\Tests\Subscription;

use Ogone\Subscription\SubscriptionPeriod;

class SubscriptionPeriodTest extends \PHPUnit_Framework_TestCase
{

    /** @test */
    public function UnitMustBeValid()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->createPeriod('not an actual unit');
    }

    /** @test */
    public function SettingUnitToWeeklyChecksMoment()
    {
        $period = $this->createPeriod(SubscriptionPeriod::UNIT_DAILY, 12, 8);
        $this->setExpectedException('InvalidArgumentException');
        $period->setUnit(SubscriptionPeriod::UNIT_WEEKLY);
    }

    /** @test */
    public function SettingUnitToMonthlyChecksMoment()
    {
        $period = $this->createPeriod(SubscriptionPeriod::UNIT_DAILY, 12, 29);
        $this->setExpectedException('InvalidArgumentException');
        $period->setUnit(SubscriptionPeriod::UNIT_MONTHLY);
    }

    /**
     * @test
     * @dataProvider unitProvider
     */
    public function UnitCanBeSetRight($unit)
    {
        $period = $this->createPeriod($unit);
        $this->assertEquals($unit, $period->getUnit());
    }

    /** @test */
    public function IntervalMustBeInteger()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->createPeriod(SubscriptionPeriod::UNIT_DAILY, 'not an int');
    }

    /** @test */
    public function IntervalMustBePositive()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->createPeriod(SubscriptionPeriod::UNIT_DAILY, -12);
    }

    /** @test */
    public function IntervalMustNotBeTooBig()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->createPeriod(SubscriptionPeriod::UNIT_DAILY, 150_000_000_000_000_000);
    }

    /**
     * @test
     * @dataProvider intProvider
     */
    public function IntervalCanBeSetRight($interval)
    {
        $period = $this->createPeriod(SubscriptionPeriod::UNIT_DAILY, $interval);
        $this->assertEquals($interval, $period->getInterval());
    }

    /** @test */
    public function MomentMustBeInt()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->createPeriod(SubscriptionPeriod::UNIT_DAILY, 12, 'not an int');
    }

    /** @test */
    public function MomentMustBePositive()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->createPeriod(SubscriptionPeriod::UNIT_DAILY, 12, -12);
    }

    /** @test */
    public function MomentMustNotBeTooBig()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->createPeriod(SubscriptionPeriod::UNIT_DAILY, 12, 150_000_000_000_000_000);
    }

    /**
     * @test
     * @dataProvider badUnitMomentComboProvider
     */
    public function MomentChecksUnit($unit, $interval)
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->createPeriod($unit, 12, $interval);
    }

    /**
     * @test
     * @dataProvider intProvider
     */
    public function MomentCanBeSetRight($moment)
    {
        $period = $this->createPeriod(SubscriptionPeriod::UNIT_DAILY, 12, $moment);
        $this->assertEquals($moment, $period->getMoment());
    }

    public function unitProvider(): array
    {
        return [[SubscriptionPeriod::UNIT_DAILY], [SubscriptionPeriod::UNIT_WEEKLY], [SubscriptionPeriod::UNIT_MONTHLY]];
    }

    public function intProvider(): array
    {
        return [[1], [5], [32], [123546]];
    }

    public function badUnitMomentComboProvider(): array
    {
        return [[SubscriptionPeriod::UNIT_WEEKLY, 8], [SubscriptionPeriod::UNIT_MONTHLY, 29]];
    }

    protected function createPeriod($unit = SubscriptionPeriod::UNIT_DAILY, $interval = 12, $moment = 6): SubscriptionPeriod
    {
        return new SubscriptionPeriod($unit, $interval, $moment);
    }
}
