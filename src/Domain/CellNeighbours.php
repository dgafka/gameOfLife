<?php

namespace Madkom\Domain;
use Webmozart\Assert\Assert;


/**
 * @package Madkom
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class CellNeighbours
{
    /**
     * @var Cell|null
     */
    private $topLeft;
    /**
     * @var Cell|null
     */
    private $top;
    /**
     * @var Cell|null
     */
    private $topRight;
    /**
     * @var Cell|null
     */
    private $centralLeft;
    /**
     * @var  Cell
     */
    private $central;
    /**
     * @var Cell|null
     */
    private $centerRight;
    /**
     * @var Cell|null
     */
    private $bottomLeft;
    /**
     * @var Cell|null
     */
    private $bottom;
    /**
     * @var Cell|null
     */
    private $bottomRight;

    /**
     * CellNeighbours constructor.
     * @param array $linesWithCells
     * @param int $centralLineIndex
     * @param int $centralCellIndex
     */
    public function __construct(array $linesWithCells, int $centralLineIndex, int $centralCellIndex)
    {
        $this->initialize($linesWithCells, $centralLineIndex, $centralCellIndex);
    }

    /**
     * @return Cell
     */
    public function centralCell() : Cell
    {
        return $this->central;
    }

    /**
     * @param int $amount
     * @return bool
     */
    public function hasMoreAliveNeighboursThan(int $amount) : bool
    {
        return $this->countAliveNeighbours() > $amount;
    }

    /**
     * @param int $amount
     * @return bool
     */
    public function hasExactNumberOfAliveNeighboursEquals(int $amount) : bool
    {
        return $this->countAliveNeighbours() === $amount;
    }

    /**
     * @param int $amount
     * @return bool
     */
    public function hasLessAliveNeighboursThan(int $amount) : bool
    {
        return $this->countAliveNeighbours() < $amount;
    }

    /**
     * @return int
     */
    public function countAliveNeighbours() : int
    {
        $aliveCells = 0;
        foreach ($this->allNeighbours() as $cell) {
            if (!is_null($cell) && $cell->isAlive()) {
                $aliveCells += 1;
            }
        }

        return $aliveCells;
    }

    /**
     * @param array $linesWithCells
     * @param int $lineIndex
     * @param int $cellIndex
     */
    private function initialize(array $linesWithCells, int $lineIndex, int $cellIndex)
    {
        Assert::keyExists($linesWithCells, $lineIndex);
        Assert::keyExists($linesWithCells[$lineIndex], $cellIndex);

        $this->central = $this->getCellAt($linesWithCells, $lineIndex, $cellIndex);;
        $this->centralLeft = $this->getCellAt($linesWithCells, $lineIndex, $cellIndex - 1);
        $this->centerRight = $this->getCellAt($linesWithCells, $lineIndex, $cellIndex + 1);
        $this->bottom = $this->getCellAt($linesWithCells, $lineIndex - 1, $cellIndex);
        $this->bottomLeft = $this->getCellAt($linesWithCells, $lineIndex - 1, $cellIndex - 1);
        $this->bottomRight = $this->getCellAt($linesWithCells, $lineIndex - 1, $cellIndex + 1);
        $this->top = $this->getCellAt($linesWithCells, $lineIndex + 1, $cellIndex);
        $this->topLeft = $this->getCellAt($linesWithCells, $lineIndex + 1, $cellIndex - 1);
        $this->topRight = $this->getCellAt($linesWithCells, $lineIndex + 1, $cellIndex + 1);
    }

    /**
     * @param array $linesWithCells
     * @param int $lineIndex
     * @param int $cellIndex
     *
     * @return Cell|null
     */
    private function getCellAt(array $linesWithCells, int $lineIndex, int $cellIndex) : ?Cell
    {
        if (array_key_exists($lineIndex, $linesWithCells) && array_key_exists($cellIndex, $linesWithCells[$lineIndex])) {
            return $linesWithCells[$lineIndex][$cellIndex];
        }

        return null;
    }

    /**
     * @return array|Cell[]
     */
    private function allNeighbours() : array
    {
        return [
            $this->topLeft, $this->top, $this->topRight,
            $this->centralLeft, $this->centerRight,
            $this->bottomLeft, $this->bottom, $this->bottomRight
        ];
    }
}