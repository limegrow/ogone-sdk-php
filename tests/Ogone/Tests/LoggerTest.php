<?php

namespace Ogone\Tests;

use PHPUnit\Framework\TestCase;
use Ogone\Logger;
use Ogone\Logger\FileAdapter;

class LoggerTest extends TestCase
{
    public function testLog()
    {
        $logFile = sys_get_temp_dir() . '/ingenico_sdk.log';

        $adapter = new FileAdapter(['file' => $logFile]);
        $logger = new Logger($adapter);

        $logger->log($logger::INFO, 'Test');
        $this->assertEquals(true, file_exists($logFile));

        $logger->emergency('Test');
        $this->assertEquals(true, stripos(file_get_contents($logFile), $logger::EMERGENCY) !== false);

        $logger->alert('Test');
        $this->assertEquals(true, stripos(file_get_contents($logFile), $logger::ALERT) !== false);

        $logger->critical('Test');
        $this->assertEquals(true, stripos(file_get_contents($logFile), $logger::CRITICAL) !== false);

        $logger->error('Test');
        $this->assertEquals(true, stripos(file_get_contents($logFile), $logger::ERROR) !== false);

        $logger->warning('Test');
        $this->assertEquals(true, stripos(file_get_contents($logFile), $logger::WARNING) !== false);

        $logger->notice('Test');
        $this->assertEquals(true, stripos(file_get_contents($logFile), $logger::NOTICE) !== false);

        $logger->info('Test');
        $this->assertEquals(true, stripos(file_get_contents($logFile), $logger::INFO) !== false);

        $logger->debug('Test');
        $this->assertEquals(true, stripos(file_get_contents($logFile), $logger::DEBUG) !== false);

        return $this;
    }
}