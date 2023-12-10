<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/config',
//        __DIR__ . '/node_modules',
        __DIR__ . '/public',
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);


    $rectorConfig->sets([
        SetList::CODE_QUALITY,
        LevelSetList::UP_TO_PHP_82,
        SetList::DEAD_CODE,
        SetList::CODING_STYLE
    ]);
};
