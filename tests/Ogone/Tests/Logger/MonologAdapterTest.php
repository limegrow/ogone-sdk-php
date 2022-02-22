<?php

namespace Ogone\Tests\Logger;

use Ogone\Logger;
use PHPUnit\Framework\TestCase;
use Ogone\Logger\AdapterInterface;
use Ogone\Logger\MonologAdapter;

class MonologAdapterTest extends TestCase
{
    public function testLogAdapter()
    {
        $adapter = new MonologAdapter(['logger' => null]);
        $this->assertInstanceOf(AdapterInterface::class, $adapter);
        $this->assertNull($adapter->log(Logger::INFO, 'Test'));
    }
}
