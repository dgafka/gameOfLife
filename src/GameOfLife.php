<?php

namespace Madkom;

/**
 * Class GameOfLife
 * @package Madkom
 */
class GameOfLife
{
    /**
     * @var array
     */
    private $boardWithCells;

    /**
     * GameOfLife constructor.
     * @param array $boardWithCells
     */
    public function __construct(array $boardWithCells)
    {
        $this->boardWithCells = $boardWithCells;
    }


    public function calculateNextGeneration() : void
    {
        $nextGenerationBoard = [];
        for ($lineIndex = 0; $lineIndex < count($this->boardWithCells); $lineIndex++) {
            $nextGenerationBoard[] = [];
            for ($cellInLineIndex = 0; $cellInLineIndex < count($this->boardWithCells[$lineIndex]); $cellInLineIndex++) {
                if (
                    $this->boardWithCells[$lineIndex][$cellInLineIndex] == true
                    && $this->isInLifeArea($lineIndex, $cellInLineIndex)
                ) {
                    $nextGenerationBoard[$lineIndex][$cellInLineIndex] = true;

//                    echo "Line {$lineIndex} with {$cellInLineIndex} is true\n";
                    continue;
                }

//                echo "Line {$lineIndex} and {$cellInLineIndex} is false\n";
                $nextGenerationBoard[$lineIndex][$cellInLineIndex] = false;
            }
        }

        $this->boardWithCells = $nextGenerationBoard;
    }

    /**
     * @return array
     */
    public function currentBoard() : array
    {
        return $this->boardWithCells;
    }

    /**
     * @return int
     */
    public function generation() : int
    {
        return 2;
    }

    /**
     * @param int $lineIndex
     * @param int $cellIndex
     * @return bool
     */
    public function isAtTheEdgeOfTheBoard(int $lineIndex, int $cellIndex) : bool
    {
        return !array_key_exists($cellIndex - 1, $this->boardWithCells[$lineIndex]) || !array_key_exists($cellIndex + 1, $this->boardWithCells[$lineIndex]);
    }

    /**
     * @param int $lineIndex
     * @param int $cellIndex
     * @return bool
     */
    public function isInLifeArea(int $lineIndex, int $cellIndex):bool
    {
        if ($this->countSurroundingAliveCells($lineIndex, $cellIndex) >= 2) {
            return true;
        }

        return false;
    }

    /**
     * @param int $cellIndex
     * @param int $lineIndex
     * @return int
     */
    private function countSurroundingAliveCells(int $lineIndex, int $cellIndex) : int
    {
        $surroundingAliveCells = 0;

        if (array_key_exists($cellIndex - 1, $this->boardWithCells[$lineIndex]) && $this->boardWithCells[$lineIndex][$cellIndex - 1] == true) {
           $surroundingAliveCells++;
        }
        if (array_key_exists($cellIndex + 1, $this->boardWithCells[$lineIndex]) && $this->boardWithCells[$lineIndex][$cellIndex + 1] == true) {
            $surroundingAliveCells++;
        }
        if (array_key_exists($lineIndex + 1, $this->boardWithCells) && array_key_exists($cellIndex, $this->boardWithCells[$lineIndex + 1]) && $this->boardWithCells[$lineIndex + 1][$cellIndex] == true) {
            $surroundingAliveCells++;
        }
        if (array_key_exists($lineIndex - 1, $this->boardWithCells) && array_key_exists($cellIndex, $this->boardWithCells[$lineIndex - 1]) && $this->boardWithCells[$lineIndex - 1][$cellIndex] == true) {
            $surroundingAliveCells++;
        }
        if (array_key_exists($lineIndex + 1, $this->boardWithCells) && array_key_exists($cellIndex - 1, $this->boardWithCells[$lineIndex + 1]) && $this->boardWithCells[$lineIndex + 1][$cellIndex -1] == true) {
            $surroundingAliveCells++;
        }
        if (array_key_exists($lineIndex + 1, $this->boardWithCells) && array_key_exists($cellIndex + 1, $this->boardWithCells[$lineIndex + 1]) && $this->boardWithCells[$lineIndex + 1][$cellIndex + 1] == true) {
            $surroundingAliveCells++;
        }
        if (array_key_exists($lineIndex - 1, $this->boardWithCells) && array_key_exists($cellIndex - 1, $this->boardWithCells[$lineIndex - 1]) && $this->boardWithCells[$lineIndex - 1][$cellIndex -1] == true) {
            $surroundingAliveCells++;
        }
        if (array_key_exists($lineIndex - 1, $this->boardWithCells) && array_key_exists($cellIndex + 1, $this->boardWithCells[$lineIndex - 1]) && $this->boardWithCells[$lineIndex - 1][$cellIndex + 1] == true) {
            $surroundingAliveCells++;
        }

        return $surroundingAliveCells;
    }
}
