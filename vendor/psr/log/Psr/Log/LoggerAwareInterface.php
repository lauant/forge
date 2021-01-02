<?php

namespace Lauant\Forge\Psr\Log;

/**
 * Describes a logger-aware instance.
 */
interface LoggerAwareInterface
{
    /**
     * Sets a logger instance on the object.
     *
     * @param LoggerInterface $logger
     *
     * @return void
     */
    public function setLogger(\Lauant\Forge\Psr\Log\LoggerInterface $logger);
}
