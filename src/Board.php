<?php

namespace Madkom;

use Webmozart\Assert\Assert;

/**
 * @package Madkom
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class Board
{
    /** @var  array */
    private $linesWithCells;

    /**
     * Board constructor.
     * @param array $linesWithCells
     */
    public function __construct(array $linesWithCells)
    {
        $this->initialize($linesWithCells);
    }
    /**
     * @param array $linesWithCells
     */
    private function initialize(array $linesWithCells) : void
    {
        Assert::allIsArray($linesWithCells);
        foreach ($linesWithCells as $line) {
            Assert::allIsInstanceOf($line, Cell::class);
        }

        $this->linesWithCells = $linesWithCells;
    }
}