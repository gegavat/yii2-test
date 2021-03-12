<?php

function debug($var, $end=true) {
    echo "<div class='text-left'><pre>" . print_r ($var, true) . "</pre></div>";
    if ( $end ) exit;
}
function debugToFile($var, $end=true, $fileName='debug-file.txt') {
    $pathToDebugFile = __DIR__ . '/runtime/logs/';
    file_put_contents($pathToDebugFile.$fileName, print_r ($var, true));
    if ( $end ) exit;
}