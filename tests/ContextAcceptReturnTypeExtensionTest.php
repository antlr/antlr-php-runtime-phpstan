<?php

declare(strict_types=1);

namespace Antlr\Antlr4\Runtime\PhpStan\Tests;

use PHPStan\Testing\LevelsTestCase;

final class ContextAcceptReturnTypeExtensionTest extends LevelsTestCase
{
    /**
     * @return string[][]
     */
    public function dataTopics() : array
    {
        return [
            ['getterReturnType'],
        ];
    }

    public function getDataPath() : string
    {
        return __DIR__ . '/Fixtures';
    }

    public function getPhpStanExecutablePath() : string
    {
        return __DIR__ . '/../vendor/bin/phpstan';
    }

    public function getPhpStanConfigPath() : ?string
    {
        return __DIR__ . '/../extension.neon';
    }
}
