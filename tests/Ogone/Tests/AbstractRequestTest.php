<?php

namespace Ogone\Tests;

use PHPUnit\Framework\TestCase;
use Ogone\Ecommerce\EcommercePaymentRequest;
use Ogone\Logger\FileAdapter;

class AbstractRequestTest extends TestCase
{
    public function testSetLogger()
    {
        //$request = new EcommercePaymentRequest();
        //new FileAdapter(['file' => sys_get_temp_dir() . '/log.txt']);
    }
}