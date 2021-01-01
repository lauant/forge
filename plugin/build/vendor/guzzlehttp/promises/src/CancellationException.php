<?php

namespace Lauant\MCD\GuzzleHttp\Promise;

/**
 * Exception that is set as the reason for a promise that has been cancelled.
 */
class CancellationException extends \Lauant\MCD\GuzzleHttp\Promise\RejectionException
{
}
