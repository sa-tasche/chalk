<?php

/**
 * A collection of available background colors
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
 * Class BackgroundColor
 *
 * @package Chalk
 */
final class BackgroundColor
{
    const NONE = '49';
    const BLACK = '40';
    const RED = '41';
    const GREEN = '42';
    const YELLOW = '43';
    const BLUE = '44';
    const MAGENTA = '45';
    const CYAN = '46';
    const LIGHT_GRAY = '47';
    const DARK_GRAY = '100';
    const LIGHT_RED = '101';
    const LIGHT_GREEN = '102';
    const LIGHT_YELLOW = '103';
    const LIGHT_BLUE = '104';
    const LIGHT_MAGENTA = '105';
    const LIGHT_CYAN = '106';
    const WHITE = '107';

    /**
     * Returns the background color reset sequence
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
