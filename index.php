<?php

if (!session_id()) {
    session_start();
}

set_include_path(implode(PATH_SEPARATOR, [get_include_path(), $_SERVER['DOCUMENT_ROOT'] . '/module',]));

function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require $fileName;
}
spl_autoload_register('autoload');

$request = new \Shop\Service\Request();

echo $request->route();