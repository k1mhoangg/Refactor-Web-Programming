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

function appendControllerPath($path)
{
    return 'Controller\\' . $path;
}

function sanitizeInput($input)
{
    return htmlspecialchars(strip_tags($input), ENT_QUOTES, 'UTF-8');
}
?>