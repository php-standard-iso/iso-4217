<?php

declare(strict_types=1);

namespace Iso4217Test;

use Iso4217\AlphaCode;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

use function ctype_upper;
use function is_string;
use function str_replace;
use function strlen;

class AlphaCodeTest extends TestCase
{
    /**
     * @test
     */
    public function constantValuesAreStringUppercase()
    {
        $reflectionClass = new ReflectionClass(AlphaCode::class);
        $values          = $reflectionClass->getConstants();

        foreach ($values as $value) {
            $this->assertTrue(is_string($value), $value);
            $this->assertTrue(ctype_upper($value), $value);
        }
    }

    /**
     * @test
     */
    public function constantValuesHas3Characters()
    {
        $reflectionClass = new ReflectionClass(AlphaCode::class);
        $values          = $reflectionClass->getConstants();

        foreach ($values as $value) {
            $this->assertEquals(3, strlen($value), $value);
        }
    }

    /**
     * @test
     */
    public function constantKeysAreUpperCase()
    {
        $reflectionClass = new ReflectionClass(AlphaCode::class);
        $values          = $reflectionClass->getConstants();

        foreach ($values as $key => $value) {
            $keyWithoutUnderscore = str_replace('_', '', $key);
            $keyWithoutUnderscore = str_replace('9', '', $keyWithoutUnderscore);
            $keyWithoutUnderscore = str_replace('17', '', $keyWithoutUnderscore);

            $this->assertTrue(ctype_upper($keyWithoutUnderscore), $key);
        }
    }
}
