<?php

declare(strict_types=1);

namespace Iso4217Test;

use Iso4217\AlphaCode;
use Iso4217\NumericCode;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

use function ctype_upper;
use function is_int;
use function str_replace;

class NumericCodeTest extends TestCase
{
    /**
     * @test
     */
    public function constantValuesInteger()
    {
        $reflectionClass = new ReflectionClass(NumericCode::class);
        $values          = $reflectionClass->getConstants();

        foreach ($values as $value) {
            $this->assertTrue(is_int($value), (string) $value);
        }
    }

    /**
     * @test
     */
    public function constantValuesAreBetween0And999()
    {
        $reflectionClass = new ReflectionClass(NumericCode::class);
        $values          = $reflectionClass->getConstants();

        foreach ($values as $value) {
            $this->assertGreaterThan(0, $value, (string) $value);
            $this->assertLessThan(1000, $value, (string) $value);
        }
    }

    /**
     * @test
     */
    public function constantKeysAreUpperCase()
    {
        $reflectionClass = new ReflectionClass(NumericCode::class);
        $values          = $reflectionClass->getConstants();

        foreach ($values as $key => $value) {
            $keyWithoutUnderscore = str_replace('_', '', $key);
            $keyWithoutUnderscore = str_replace('9', '', $keyWithoutUnderscore);
            $keyWithoutUnderscore = str_replace('17', '', $keyWithoutUnderscore);

            $this->assertTrue(ctype_upper($keyWithoutUnderscore), $key);
        }
    }

    /**
     * @test
     */
    public function constantKeysExistInAlphaCode()
    {
        $reflectionClass          = new ReflectionClass(NumericCode::class);
        $values                   = $reflectionClass->getConstants();
        $alphaCodeReflectionClass = new ReflectionClass(AlphaCode::class);

        foreach ($values as $key => $value) {
            $hasKey = (bool) $alphaCodeReflectionClass->getConstant($key);

            $this->assertTrue($hasKey, $key);
        }
    }
}
