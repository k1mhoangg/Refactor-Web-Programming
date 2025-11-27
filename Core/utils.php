<?php

function pprint($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}

function getBaseUrl()
{
    $scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
    return rtrim(dirname($scriptName), '/');
}

?>