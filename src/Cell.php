<?php

namespace Madkom;

/**
 * @package Madkom
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class Cell
{
    /**
     * @var bool
     */
    private $isAlive;

    /**
     * Cell constructor.
     * @param bool $isAlive
     * @internal
     */
    public function __construct(bool $isAlive)
    {
        $this->isAlive = $isAlive;
    }

    /**
     * @return bool
     */
    public function isAlive() : bool
    {
        return $this->isAlive;
    }
}