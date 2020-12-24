<?php

namespace unit;

use PHPUnit\Framework\TestCase;

class DifferTest extends TestCase
{
    public function testSuccessDiff(): void
    {
        $result = \Differ\Differ\genDiff(
            __DIR__ . '/../fixtures/Differ/file1.json',
            __DIR__ . '/../fixtures/Differ/file2.json'
        );

        $expected = <<<STR
{
    "- follow": false,
    "  host": "hexlet.io",
    "- proxy": "123.234.53.22",
    "- timeout": 50,
    "+ timeout": 20,
    "+ verbose": true
}
STR;
        self::assertSame($expected, $result);
    }

    public function testFailDiff(): void
    {
        $result = \Differ\Differ\genDiff(
            __DIR__ . '/../fixtures/Differ/file1.json',
            __DIR__ . '/../fixtures/Differ/file2.json'
        );

        $expected = <<<STR
{
    "- follow": false,
    "  host": "hexlet.io",
    "- proxy": "123.234.53.22",
    "- timeout": 50,
    "+ timeout": 20
}
STR;
        self::assertNotSame($expected, $result);
    }
}
