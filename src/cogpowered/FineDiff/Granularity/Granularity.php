<?php

/**
 * FINE granularity DIFF
 *
 * Computes a set of instructions to convert the content of
 * one string into another.
 *
 * Originally created by Raymond Hill (https://github.com/gorhill/PHP-FineDiff), brought up
 * to date by Cog Powered (https://github.com/cogpowered/FineDiff).
 *
 * @copyright Copyright 2011 (c) Raymond Hill (http://raymondhill.net/blog/?p=441)
 * @copyright Copyright 2013 (c) Robert Crowe (http://cogpowered.com)
 * @link https://github.com/cogpowered/FineDiff
 * @version 0.0.1
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

namespace cogpowered\FineDiff\Granularity;

/**
 * Granularities should extend this class.
 */
abstract class Granularity implements GranularityInterface, \ArrayAccess, \Countable
{
    /**
     * @var array Extending granularities should override this.
     */
    protected $delimiters = array();

    /**
     * @inheritdoc
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->delimiters[$offset]);
    }

    /**
     * @inheritdoc
     */
    public function offsetGet(mixed $offset): mixed
    {
        return isset($this->delimiters[$offset]) ? $this->delimiters[$offset] : null;
    }

    /**
     * @inheritdoc
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (is_null($offset)) {
            $this->delimiters[] = $value;
        } else {
            $this->delimiters[$offset] = $value;
        }
    }

    /**
     * @inheritdoc
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->delimiters[$offset]);
    }

    /**
     * Return the number of delimiters this granularity contains.
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->delimiters);
    }

    /**
     * @inheritdoc
     */
    public function getDelimiters()
    {
        return $this->delimiters;
    }

    /**
     * @inheritdoc
     */
    public function setDelimiters(array $delimiters)
    {
        $this->delimiters = $delimiters;
    }
}