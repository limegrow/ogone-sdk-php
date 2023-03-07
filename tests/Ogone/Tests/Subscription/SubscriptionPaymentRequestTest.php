<?php

namespace Ogone\Tests\Subscription;

use Ogone\Subscription\SubscriptionPaymentRequest;
use Ogone\Subscription\SubscriptionPeriod;
use Ogone\Tests\ShaComposer\FakeShaComposer;

class SubscriptionPaymentRequestTest extends \PHPUnit_Framework_TestCase
{

    /** @test */
    public function AmountCanBeZero()
    {
        $paymentRequest = $this->createSubscriptionRequest();
        $paymentRequest->setAmount(0);
        $this->assertEquals(0, $paymentRequest->getAmount());
    }

    /**
     * @test
     * @dataProvider provideBadParameters
     * @expectedException \InvalidArgumentException
     */
    public function BadParametersCauseExceptions($method, $value)
    {
        $paymentRequest = $this->createSubscriptionRequest();
        $paymentRequest->$method($value);
    }

    /**
     * @test
     * @expectedException \RuntimeException
     */
    public function IsInvalidIfSubscriptionParametersAreMissing()
    {
        $paymentRequest = $this->createSubscriptionRequest();
        $paymentRequest->setPspid('12');
        $paymentRequest->setCurrency('EUR');
        $paymentRequest->setAmount(0);
        $paymentRequest->setOrderId('10');
        $paymentRequest->validate();
    }

    /** @test */
    public function RequestCanBeValid()
    {
        $paymentRequest = $this->createSubscriptionRequest();
        $paymentRequest->setPspid('12');
        $paymentRequest->setCurrency('EUR');
        $paymentRequest->setAmount(0);
        $paymentRequest->setOrderId('10');
        $paymentRequest->setSubscriptionId('12');
        $paymentRequest->setSubscriptionAmount(13);
        $paymentRequest->setSubscriptionComment('test');
        $paymentRequest->setSubscriptionDescription('description');
        $paymentRequest->setSubscriptionOrderId('13');
        $paymentRequest->setSubscriptionPeriod($this->createSubscriptionPeriod());
        $paymentRequest->setSubscriptionStartdate(new \DateTime());
        $paymentRequest->setSubscriptionEnddate(new \DateTime());
        $paymentRequest->setSubscriptionStatus(1);
        $paymentRequest->validate();
        $this->assertTrue(true);
    }

    public function provideBadParameters(): array
    {

        return [['setAmount', 10.50], ['setAmount', -1], ['setAmount', 150_000_000_000_000_000], ['setSubscriptionId', 'this is a little more than 50 characters, which is truly the max amount'], ['setSubscriptionId', '$e©ial Ch@r@cters'], ['setSubscriptionAmount', 10.50], ['setSubscriptionAmount', 0], ['setSubscriptionAmount', -1], ['setSubscriptionAmount', 150_000_000_000_000_000], ['setSubscriptionDescription', 'this is a little more than 100 characters- which is truly the maximum amount of characters one can pass as a parameter to this particular function'], ['setSubscriptionDescription', 'special, characters!'], ['setSubscriptionOrderId', 'this is a little more than 40 characters- which is truly the max amount'], ['setSubscriptionOrderId', 'special, characters!'], ['setSubscriptionStatus', 5], ['setSubscriptionComment', 'this particular string is supposed to be longer than 200 characters- which will require me to type for quite a while longer than the string that needed to exceed 50 chars- which is- in fact- significantly lower than 200'], ['setSubscriptionComment', 'special, characters!']];
    }

    protected function createSubscriptionRequest(): SubscriptionPaymentRequest
    {
        return new SubscriptionPaymentRequest(new FakeShaComposer());
    }

    protected function createSubscriptionPeriod(): SubscriptionPeriod
    {
        return new SubscriptionPeriod(SubscriptionPeriod::UNIT_DAILY, 12, 7);
    }
}
