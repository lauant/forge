<?php

namespace Lauant\MCD;

// Don't redefine the functions if included multiple times.
if (!\function_exists('Lauant\\MCD\\GuzzleHttp\\Promise\\promise_for')) {
    require __DIR__ . '/functions.php';
}
