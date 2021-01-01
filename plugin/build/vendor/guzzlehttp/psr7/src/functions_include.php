<?php

namespace Lauant\MCD;

// Don't redefine the functions if included multiple times.
if (!\function_exists('Lauant\\MCD\\GuzzleHttp\\Psr7\\str')) {
    require __DIR__ . '/functions.php';
}
