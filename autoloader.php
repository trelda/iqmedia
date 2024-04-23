<?php


$configuration = json_decode(
    file_get_contents('shortifyer.json'),
    true
);

$namespaces = $configuration['autoload']['psr-4'];


function fqcnToPath(string $fqcn, string $prefix) {
    $relativeClass = ltrim($fqcn, $prefix);

    return str_replace('\\', '/', $relativeClass) . '.php';
}

spl_autoload_register(function (string $class) use ($namespaces) {
    $prefix = strtok($class, '\\') . '\\';

    if (!array_key_exists($prefix, $namespaces)) return;

    $baseDirectory = $namespaces[$prefix];
    $path = fqcnToPath($class, $prefix);

    $fileName = $baseDirectory . '/' . $path;
    
    if (file_exists($fileName)) {
        require $fileName;
    }
});
