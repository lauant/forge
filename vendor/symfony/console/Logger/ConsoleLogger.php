<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Lauant\Forge\Symfony\Component\Console\Logger;

use Lauant\Forge\Psr\Log\AbstractLogger;
use Lauant\Forge\Psr\Log\InvalidArgumentException;
use Lauant\Forge\Psr\Log\LogLevel;
use Lauant\Forge\Symfony\Component\Console\Output\ConsoleOutputInterface;
use Lauant\Forge\Symfony\Component\Console\Output\OutputInterface;
/**
 * PSR-3 compliant console logger.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 *
 * @see http://www.php-fig.org/psr/psr-3/
 */
class ConsoleLogger extends \Lauant\Forge\Psr\Log\AbstractLogger
{
    const INFO = 'info';
    const ERROR = 'error';
    private $output;
    private $verbosityLevelMap = array(\Lauant\Forge\Psr\Log\LogLevel::EMERGENCY => \Lauant\Forge\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \Lauant\Forge\Psr\Log\LogLevel::ALERT => \Lauant\Forge\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \Lauant\Forge\Psr\Log\LogLevel::CRITICAL => \Lauant\Forge\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \Lauant\Forge\Psr\Log\LogLevel::ERROR => \Lauant\Forge\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \Lauant\Forge\Psr\Log\LogLevel::WARNING => \Lauant\Forge\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_NORMAL, \Lauant\Forge\Psr\Log\LogLevel::NOTICE => \Lauant\Forge\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_VERBOSE, \Lauant\Forge\Psr\Log\LogLevel::INFO => \Lauant\Forge\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_VERY_VERBOSE, \Lauant\Forge\Psr\Log\LogLevel::DEBUG => \Lauant\Forge\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_DEBUG);
    private $formatLevelMap = array(\Lauant\Forge\Psr\Log\LogLevel::EMERGENCY => self::ERROR, \Lauant\Forge\Psr\Log\LogLevel::ALERT => self::ERROR, \Lauant\Forge\Psr\Log\LogLevel::CRITICAL => self::ERROR, \Lauant\Forge\Psr\Log\LogLevel::ERROR => self::ERROR, \Lauant\Forge\Psr\Log\LogLevel::WARNING => self::INFO, \Lauant\Forge\Psr\Log\LogLevel::NOTICE => self::INFO, \Lauant\Forge\Psr\Log\LogLevel::INFO => self::INFO, \Lauant\Forge\Psr\Log\LogLevel::DEBUG => self::INFO);
    public function __construct(\Lauant\Forge\Symfony\Component\Console\Output\OutputInterface $output, array $verbosityLevelMap = array(), array $formatLevelMap = array())
    {
        $this->output = $output;
        $this->verbosityLevelMap = $verbosityLevelMap + $this->verbosityLevelMap;
        $this->formatLevelMap = $formatLevelMap + $this->formatLevelMap;
    }
    /**
     * {@inheritdoc}
     */
    public function log($level, $message, array $context = array())
    {
        if (!isset($this->verbosityLevelMap[$level])) {
            throw new \Lauant\Forge\Psr\Log\InvalidArgumentException(\sprintf('The log level "%s" does not exist.', $level));
        }
        // Write to the error output if necessary and available
        if (self::ERROR === $this->formatLevelMap[$level] && $this->output instanceof \Lauant\Forge\Symfony\Component\Console\Output\ConsoleOutputInterface) {
            $output = $this->output->getErrorOutput();
        } else {
            $output = $this->output;
        }
        if ($output->getVerbosity() >= $this->verbosityLevelMap[$level]) {
            $output->writeln(\sprintf('<%1$s>[%2$s] %3$s</%1$s>', $this->formatLevelMap[$level], $level, $this->interpolate($message, $context)));
        }
    }
    /**
     * Interpolates context values into the message placeholders.
     *
     * @author PHP Framework Interoperability Group
     *
     * @param string $message
     * @param array  $context
     *
     * @return string
     */
    private function interpolate($message, array $context)
    {
        // build a replacement array with braces around the context keys
        $replace = array();
        foreach ($context as $key => $val) {
            if (!\is_array($val) && (!\is_object($val) || \method_exists($val, '__toString'))) {
                $replace[\sprintf('{%s}', $key)] = $val;
            }
        }
        // interpolate replacement values into the message and return
        return \strtr($message, $replace);
    }
}
