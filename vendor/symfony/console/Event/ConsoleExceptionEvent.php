<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Lauant\Forge\Symfony\Component\Console\Event;

use Lauant\Forge\Symfony\Component\Console\Command\Command;
use Lauant\Forge\Symfony\Component\Console\Input\InputInterface;
use Lauant\Forge\Symfony\Component\Console\Output\OutputInterface;
/**
 * Allows to handle exception thrown in a command.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class ConsoleExceptionEvent extends \Lauant\Forge\Symfony\Component\Console\Event\ConsoleEvent
{
    private $exception;
    private $exitCode;
    public function __construct(\Lauant\Forge\Symfony\Component\Console\Command\Command $command, \Lauant\Forge\Symfony\Component\Console\Input\InputInterface $input, \Lauant\Forge\Symfony\Component\Console\Output\OutputInterface $output, \Exception $exception, $exitCode)
    {
        parent::__construct($command, $input, $output);
        $this->setException($exception);
        $this->exitCode = (int) $exitCode;
    }
    /**
     * Returns the thrown exception.
     *
     * @return \Exception The thrown exception
     */
    public function getException()
    {
        return $this->exception;
    }
    /**
     * Replaces the thrown exception.
     *
     * This exception will be thrown if no response is set in the event.
     *
     * @param \Exception $exception The thrown exception
     */
    public function setException(\Exception $exception)
    {
        $this->exception = $exception;
    }
    /**
     * Gets the exit code.
     *
     * @return int The command exit code
     */
    public function getExitCode()
    {
        return $this->exitCode;
    }
}
