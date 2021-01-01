<?php

namespace Lauant\MCD\GuzzleHttp\Promise;

final class Is
{
    /**
     * Returns true if a promise is pending.
     *
     * @return bool
     */
    public static function pending(\Lauant\MCD\GuzzleHttp\Promise\PromiseInterface $promise)
    {
        return $promise->getState() === \Lauant\MCD\GuzzleHttp\Promise\PromiseInterface::PENDING;
    }
    /**
     * Returns true if a promise is fulfilled or rejected.
     *
     * @return bool
     */
    public static function settled(\Lauant\MCD\GuzzleHttp\Promise\PromiseInterface $promise)
    {
        return $promise->getState() !== \Lauant\MCD\GuzzleHttp\Promise\PromiseInterface::PENDING;
    }
    /**
     * Returns true if a promise is fulfilled.
     *
     * @return bool
     */
    public static function fulfilled(\Lauant\MCD\GuzzleHttp\Promise\PromiseInterface $promise)
    {
        return $promise->getState() === \Lauant\MCD\GuzzleHttp\Promise\PromiseInterface::FULFILLED;
    }
    /**
     * Returns true if a promise is rejected.
     *
     * @return bool
     */
    public static function rejected(\Lauant\MCD\GuzzleHttp\Promise\PromiseInterface $promise)
    {
        return $promise->getState() === \Lauant\MCD\GuzzleHttp\Promise\PromiseInterface::REJECTED;
    }
}
