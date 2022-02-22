<?php

namespace Ogone;

use Ogone\Logger\AdapterInterface;

class Logger
{
    const EMERGENCY = 'emergency';
    const ALERT     = 'alert';
    const CRITICAL  = 'critical';
    const ERROR     = 'error';
    const WARNING   = 'warning';
    const NOTICE    = 'notice';
    const INFO      = 'info';
    const DEBUG     = 'debug';

    /**
     * @var AdapterInterface
     */
    private $adapter;

    /**
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Logs with emergency level.
     *
     * @param string $message
     * @param array $context
     */
    public function emergency($message, array $context = [])
    {
        $this->log(self::EMERGENCY, $message, $context);
    }

    /**
     * Logs with error level.
     *
     * @param string $message
     * @param array $context
     */
    public function alert($message, array $context = [])
    {
        $this->log(self::ALERT, $message, $context);
    }

    /**
     * Logs with critical level.
     *
     * @param string $message
     * @param array $context
     */
    public function critical($message, array $context = [])
    {
        $this->log(self::CRITICAL, $message, $context);
    }

    /**
     * Logs with error level.
     *
     * @param string $message
     * @param array $context
     */
    public function error($message, array $context = [])
    {
        $this->log(self::ERROR, $message, $context);
    }

    /**
     * Logs with warning level.
     *
     * @param string $message
     * @param array $context
     */
    public function warning($message, array $context = [])
    {
        $this->log(self::WARNING, $message, $context);
    }

    /**
     * Logs with notice level.
     *
     * @param string $message
     * @param array $context
     */
    public function notice($message, array $context = [])
    {
        $this->log(self::NOTICE, $message, $context);
    }

    /**
     * Logs with info level.
     *
     * @param string $message
     * @param array $context
     */
    public function info($message, array $context = [])
    {
        $this->log(self::INFO, $message, $context);
    }

    /**
     * Logs with debug level.
     *
     * @param string $message
     * @param array $context
     */
    public function debug($message, array $context = [])
    {
        $this->log(self::DEBUG, $message, $context);
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     */
    public function log($level, $message, array $context = [])
    {
        $this->adapter->log($level, $message, $context);
    }
}
