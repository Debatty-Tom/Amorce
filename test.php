<?php

$directory = __DIR__ . '/resources/views';
$pattern = '/__\([\'"](.+?)[\'"]\)/';
$strings = [];

$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));
foreach ($files as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getRealPath());
        if (preg_match_all($pattern, $content, $matches)) {
            $strings = array_merge($strings, $matches[1]);
        }
    }
}

$strings = array_unique($strings);
foreach ($strings as $string) {
    if (str_contains($string, 'amorce')){
        continue;
    }
    print $string . PHP_EOL;
}
