<?php

/**
 * A collection of available colors
 *
 * PHP version 5.4.0
 *
 * Copyright (c) 2015 Martin Pettersson
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * @author    Martin pettersson <martin_pettersson@outlook.com>
 * @copyright 2015 Martin Pettersson
 * @license   MIT
 * @link      https://github.com/martin-pettersson/chalk
 */

namespace Chalk;

use ReflectionClass;

/**
 * Class Color
 *
 * @package Chalk
 */
final class Color
{
    const NONE = '39';
    const BLACK = '30';
    const RED = '31';
    const GREEN = '32';
    const YELLOW = '33';
    const BLUE = '34';
    const MAGENTA = '35';
    const CYAN = '36';
    const LIGHT_GRAY = '37';
    const DARK_GRAY = '90';
    const LIGHT_RED = '91';
    const LIGHT_GREEN = '92';
    const LIGHT_YELLOW = '93';
    const LIGHT_BLUE = '94';
    const LIGHT_MAGENTA = '95';
    const LIGHT_CYAN = '96';
    const WHITE = '97';

    /**
     * Returns the color reset sequence
     *
     * @return string
     */
    public static function getResetSequence()
    {
        return Chalk::getEscapeSequence(self::NONE);
    }

    /**
     * Returns an array of the available colors
     *
     * @return array
     */
    public static function enum()
    {
        $reflection = new ReflectionClass(__CLASS__);

        return $reflection->getConstants();
    }
}
