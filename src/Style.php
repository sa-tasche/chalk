<?php

/**
 * The style object allows you to combine a number of styles
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
 * Class Style
 *
 * @package Chalk
 */
class Style
{
    const NONE = '0';
    const BOLD = '1';
    const DIM = '2';
    const UNDERLINED = '4';
    const BLINK = '5';
    const INVERTED = '7';
    const HIDDEN = '8';

    /**
     * A compiled escape sequence
     *
     * @var string
     */
    protected $escapeSequence;

    /**
     * Compiles the given styles into a single escape sequence
     *
     * @constructor
     *
     * @param int|array $styles
     */
    public function __construct($styles = null)
    {
        if (!is_null($styles)) {
            $this->setStyle($styles);
        }
    }

    /**
     * Sets the style by recompiling the escape sequence
     *
     * @param int|array $styles
     *
     * @return null
     */
    public function setStyle($styles)
    {
        $this->escapeSequence = '';

        $this->addStyle($styles);
    }

    /**
     * Appends style(s) to the escape sequence
     *
     * @param int|array $styles
     *
     * @return null
     */
    public function addStyle($styles)
    {
        foreach ((array) $styles as $style) {
            $this->escapeSequence .= Chalk::getEscapeSequence($style);
        }
    }

    /**
     * Returns the compiled escape sequence
     *
     * @return string
     */
    public function getEscapeSequence()
    {
        return $this->escapeSequence;
    }

    /**
     * Returns the style reset sequence
     *
     * @return string
     */
    public static function getResetSequence()
    {
        return Chalk::getEscapeSequence(self::NONE);
    }

    /**
     * Returns an array of the available styles
     *
     * @return array
     */
    public static function enum()
    {
        $reflection = new ReflectionClass(__CLASS__);

        return $reflection->getConstants();
    }
}
