<?php

namespace Madkom;

/**
 * @package Madkom
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class CellFactory
{
    /**
     * @param bool $type
     * @return Cell
     */
    public function create(bool $type) : Cell
    {
        return new Cell($type);
    }
}