<?php

namespace Ogone\Logger;

class MonologAdapter implements AdapterInterface
{
    /**
     * @var \Monolog\Logger|\Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * Constructor.
     *
     * @param array $options
     */
    public function __construct(array $options)
    {
        if (isset($options['logger'])) {
            $this->logger = $options['logger'];
        }
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
        if ($this->logger) {
            $this->logger->log($level, $message, $context);
        }
    }
}