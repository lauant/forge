<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Lauant\Forge\Symfony\Component\Debug;

/**
 * Registers all the debug tools.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Debug
{
    private static $enabled = \false;
    /**
     * Enables the debug tools.
     *
     * This method registers an error handler and an exception handler.
     *
     * If the Symfony ClassLoader component is available, a special
     * class loader is also registered.
     *
     * @param int  $errorReportingLevel The level of error reporting you want
     * @param bool $displayErrors       Whether to display errors (for development) or just log them (for production)
     */
    public static function enable($errorReportingLevel = \E_ALL, $displayErrors = \true)
    {
        if (static::$enabled) {
            return;
        }
        static::$enabled = \true;
        if (null !== $errorReportingLevel) {
            \error_reporting($errorReportingLevel);
        } else {
            \error_reporting(\E_ALL);
        }
        if ('cli' !== \PHP_SAPI) {
            \ini_set('display_errors', 0);
            \Lauant\Forge\Symfony\Component\Debug\ExceptionHandler::register();
        } elseif ($displayErrors && (!\ini_get('log_errors') || \ini_get('error_log'))) {
            // CLI - display errors only if they're not already logged to STDERR
            \ini_set('display_errors', 1);
        }
        if ($displayErrors) {
            \Lauant\Forge\Symfony\Component\Debug\ErrorHandler::register(new \Lauant\Forge\Symfony\Component\Debug\ErrorHandler(new \Lauant\Forge\Symfony\Component\Debug\BufferingLogger()));
        } else {
            \Lauant\Forge\Symfony\Component\Debug\ErrorHandler::register()->throwAt(0, \true);
        }
        \Lauant\Forge\Symfony\Component\Debug\DebugClassLoader::enable();
    }
}
