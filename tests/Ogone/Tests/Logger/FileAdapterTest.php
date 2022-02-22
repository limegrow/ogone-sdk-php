<?php

namespace Ogone\Tests\Logger;

use PHPUnit\Framework\TestCase;
use Ogone\Logger;
use Ogone\Logger\AdapterInterface;
use Ogone\Logger\FileAdapter;

class FileAdapterTest extends TestCase
{
    public function testLogAdapter()
    {
        $logFile = sys_get_temp_dir() . '/ingenico_sdk.log';

        $adapter = new FileAdapter(['file' => $logFile]);
        $this->assertInstanceOf(AdapterInterface::class, $adapter);

        $adapter->log(Logger::INFO, 'Test');
        $this->assertEquals(true, file_exists($logFile));
    }
}
