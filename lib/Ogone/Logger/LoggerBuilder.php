<?php
/**
 * Created by PhpStorm.
 * User: alexw
 * Date: 21/01/19
 * Time: 21:11.
 */

namespace Ogone\Logger;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\WebProcessor;
use Psr\Log\LoggerInterface;

/**
 * Class LoggerBuilder.
 */
class LoggerBuilder
{
    /** @var LoggerInterface */
    protected LoggerInterface $logger;

    /**
     * Gets Logger.
     */
    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

    /**
     * build logger.
     *
     *
     *
     * @throws \Exception
     */
    public function createLogger(string $channel, string $path = '/tmp/ogone_sdk.log', int $level = Logger::DEBUG): static
    {
        $this->logger = new Logger($channel);
        $this->logger->pushHandler(new StreamHandler($path, $level));
        $this->logger->pushProcessor(new WebProcessor());

        return $this;
    }
}
