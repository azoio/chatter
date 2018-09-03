<?php

require_once('init.php');

try {
    (new Controllers\FormController())
        ->show();
}
catch (Exception $e) {
    if ($e->getCode() != 0) {
        http_response_code($e->getCode());
    }
    else {
        http_response_code(500);
    }
    echo nl2br($e->getMessage());
}
