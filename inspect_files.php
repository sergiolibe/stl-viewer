<?php

$dir = __DIR__ . '/stl_files/';


$stl_files = getStlFilesinDir($dir);


$target_dir = __DIR__ . '/public/stl_files/';
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$stl_files_in_target_dir = getStlFilesinDir($target_dir);
foreach ($stl_files_in_target_dir as $filepath)
    unlink($filepath);


$filenames = [];
foreach ($stl_files as $stl_filepath) {

    $t0 = microtime(true);
    $shortname = extract_short_name($stl_filepath);
    $target_filepath = $target_dir . $shortname;
    if (!copy($stl_filepath, $target_filepath))
        throw new RuntimeException('Failed to cpy file from: ' . $stl_filepath . ', to: ' . $target_filepath);

    $tf = microtime(true) - $t0;
//    echo 'Copied file: ', $shortname, ' in ', $tf, 's','<br>';

    $filenames[] = [
        'filepath' => ('/stl_files/' . $shortname),
        'shortname' => $shortname
    ];
}


//var_dump($filenames);
//die();

function extract_short_name(string $filepath): string
{
    $parts = explode('/', $filepath);
    return end($parts);
}

function getStlFilesinDir(string $dir): array
{
    $lowercase_stl_files = glob($dir . '*.stl');
    $uppercase_stl_files = glob($dir . '*.STL');

    $stl_files = array_merge($lowercase_stl_files, $uppercase_stl_files);
    return $stl_files;
}