<?php

declare(strict_types=1);

namespace Iso4217Test;

use Iso4217\AlphaCode;
use Iso4217\MinorUnit;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

use function ctype_upper;
use function is_int;
use function str_replace;

class MinorUnitTest extends TestCase
{
    /**
     * @test
     */
    public function constantValuesAreInteger()
    {
        $reflectionClass = new ReflectionClass(MinorUnit::class);
        $values          = $reflectionClass->getConstants();

        foreach ($values as $value) {
            $this->assertTrue(is_int($value), (string) $value);
        }
    }

    /**
     * @test
     */
    public function constantKeysAreUpperCase()
    {
        $reflectionClass = new ReflectionClass(MinorUnit::class);
        $values          = $reflectionClass->getConstants();

        foreach ($values as $key => $value) {
            $keyWithoutUnderscore = str_replace('_', '', $key);

            $this->assertTrue(ctype_upper($keyWithoutUnderscore), $key);
        }
    }

    /**
     * @test
     */
    public function constantKeysExistInAlphaCode()
    {
        $reflectionClass          = new ReflectionClass(MinorUnit::class);
        $values                   = $reflectionClass->getConstants();
        $alphaCodeReflectionClass = new ReflectionClass(AlphaCode::class);

        foreach ($values as $key => $value) {
            $hasKey = (bool) $alphaCodeReflectionClass->getConstant($key);

            $this->assertTrue($hasKey, $key);
        }
    }
}
