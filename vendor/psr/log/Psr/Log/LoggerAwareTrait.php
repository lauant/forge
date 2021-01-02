<?php

namespace Lauant\Forge\Psr\Log;

/**
 * Basic Implementation of LoggerAwareInterface.
 */
trait LoggerAwareTrait
{
    /**
     * The logger instance.
     *
     * @var LoggerInterface
     */
    protected $logger;
    /**
     * Sets a logger.
     *
     * @param LoggerInterface $logger
     */
    public function setLogger(\Lauant\Forge\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}
