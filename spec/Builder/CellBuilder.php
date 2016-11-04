<?php

namespace spec\Builder;

use Madkom\Domain\Cell;


/**
 * @package spec\Builder
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class CellBuilder
{
    private static $cells = [];

    /**
     * @param bool $isAlive
     * @return Cell
     */
    public static function create(bool $isAlive) : Cell
    {
        $key = (int)$isAlive;
        if (array_key_exists($key, self::$cells)) {
            return self::$cells[$key];
        }

        $cell =  new Cell($isAlive);
        self::$cells[$key] = $cell;
        return $cell;
    }
}