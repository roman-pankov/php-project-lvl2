<?php

namespace Differ\Differ;

function genDiff(string $pathToFile1, string $pathToFile2): string
{
    $file1 = @file_get_contents($pathToFile1);
    $file2 = @file_get_contents($pathToFile2);

    $diff = [];

    $json1 = json_decode($file1, true);
    ksort($json1);

    $json2 = json_decode($file2, true);
    ksort($json2);

    foreach ($json1 as $key => $value) {
        if (!isset($json2[$key])) {
            $diff['- ' . $key] = $value;
            continue;
        }

        if ($value === $json2[$key]) {
            $diff['  ' . $key] = $value;
        } else {
            $diff['- ' . $key] = $value;
            $diff['+ ' . $key] = $json2[$key];
        }


        unset($json2[$key]);
    }


    foreach ($json2 as $key => $value) {
        $diff['+ ' . $key] = $value;
    }

    return json_encode($diff, JSON_PRETTY_PRINT);
}
