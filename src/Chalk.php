<?php

/**
 * A tool to style terminal output
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
 * Class Chalk
 *
 * @package  Chalk
 */
class Chalk
{
    /**
     * The terminal color escape sequence with color replace tag
     *
     * @var string
     */
    const ESCAPE_SEQUENCE = "\033[STYLEm";

    /**
     * Gives the given string the given style
     *
     * @param  string $string
     * @param  int|Style    $style
     *
     * @return string
     */
    public static function style($string, $style)
    {
        $escapeSequence = ($style instanceof Style) ? $style->getEscapeSequence() : self::getEscapeSequence($style);
        $resetSequence = ($style instanceof Style) ? Style::getResetSequence() : self::getResetSequence($style);

        return $escapeSequence . $string . $resetSequence;
    }

    /**
     * Parses the given string and inserts the color tags replacing the placeholders
     *
     * @param  string $string
     * @param  array  $styles
     *
     * @return string
     */
    public static function parse($string, array $styles)
    {
        // style the entire string if no tags are found
        if (false === strpos($string, '{')) {
            return self::style($string, reset($styles));
        }

        $i = 0;

        // loop through each tag in the string
        while (false !== $openTag = strpos($string, '{')) {
            $style = array_key_exists($i, $styles) ? $styles[$i] : end($styles);

            $escapeSequence = ($style instanceof Style) ? $style->getEscapeSequence() : self::getEscapeSequence($style);
            $resetSequence = ($style instanceof Style) ? Style::getResetSequence() : self::getResetSequence($style);

            // replace opening tag
            $string = substr_replace($string, $escapeSequence, $openTag, 1);

            if (false === $closeTag = strpos($string, '}')) {
                $closeTag = strlen($string);
            }

            // don't produce multiple identical reset tags next to each other
            if (substr($string, $closeTag - strlen($resetSequence), strlen($resetSequence)) !== $resetSequence) {
                $string = substr_replace($string, $resetSequence, $closeTag, 1);
            }

            $i++;
        }

        return $string;
    }

    /**
     * Returns a terminal escape sequence with the given style
     *
     * @param int $style
     *
     * @return string
     */
    public static function getEscapeSequence($style)
    {
        return str_replace('STYLE', $style, self::ESCAPE_SEQUENCE);
    }

    /**
     * Returns the reset sequence for the given style
     *
     * @param int|null $style
     *
     * @return string
     */
    public static function getResetSequence($style = null)
    {
        $resetSequence = Style::getResetSequence();

        if (!is_null($style)) {
            switch (true) {
                case in_array($style, Color::enum()):
                    $resetSequence = Color::getResetSequence();
                    break;
                case in_array($style, BackgroundColor::enum()):
                    $resetSequence = BackgroundColor::getResetSequence();
                    break;
            }
        }

        return $resetSequence;
    }

    /**
     * Allows the convenient use of methods like Chalk::blue
     *
     * Note: The color is case INSENSITIVE and this only works for colors
     *
     * @param  string $color
     * @param  array  $arguments
     *
     * @return string
     */
    public static function __callStatic($color, $arguments)
    {
        // normalize color
        $colorConstant = strtoupper($color);
        $reflection = new ReflectionClass(Color::class);

        // PHP default behaviour if no method is found
        if (!$reflection->hasConstant($colorConstant)) {
            trigger_error('Fatal error: Call to undefined method ' . __CLASS__ . '::' . $color . '()', E_USER_ERROR);
        }

        // PHP default behaviour if no argument is given
        if (empty($arguments)) {
            trigger_error('Warning:  Missing argument 1 for ' . __CLASS__ . '::' . $color . '()', E_USER_WARNING);
        }

        return self::style($arguments[0], $reflection->getConstant($colorConstant));
    }
}
