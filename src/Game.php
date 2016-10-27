<?php

namespace Madkom;

/**
 * Class GameOfLife
 * @package Madkom
 */
class Game
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

    /**
     * @param CellFactory $cellFactory
     */
    public function calculateNextGeneration(CellFactory $cellFactory) : void
    {
        $nextGenerationBoard = [];
        for ($lineIndex = 0; $lineIndex < count($this->boardWithCells); $lineIndex++) {
            $nextGenerationBoard[] = [];
            for ($cellInLineIndex = 0; $cellInLineIndex < count($this->boardWithCells[$lineIndex]); $cellInLineIndex++) {
                if (
                    $this->isInLifeArea($lineIndex, $cellInLineIndex)
                ) {
                    $nextGenerationBoard[$lineIndex][$cellInLineIndex] = $cellFactory->create(true);
                    echo "\nLine {$lineIndex} with {$cellInLineIndex} is true\n";
                    continue;
                }

                echo "\nLine {$lineIndex} and {$cellInLineIndex} is false\n";
                $nextGenerationBoard[$lineIndex][$cellInLineIndex] = $cellFactory->create(false);
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
    public function isInLifeArea(int $lineIndex, int $cellIndex):bool
    {
        $surroundingCells = $this->createCellNeighbours($lineIndex, $cellIndex);

        if ($this->isAbleToRevive($surroundingCells)) {
            return true;
        }

        if (!$surroundingCells->centralCell()->isAlive()) {
            return false;
        }

        if (
            $this->isOvercrowded($surroundingCells)
            ||
            $this->isUnderpopulated($surroundingCells)
        ) {
            return false;
        }

        return true;
    }

    /**
     * @param int $centralLineIndex
     * @param int $centralCellIndex
     * @return CellNeighbours
     */
    private function createCellNeighbours(int $centralLineIndex, int $centralCellIndex) : CellNeighbours
    {
        return new CellNeighbours($this->boardWithCells, $centralLineIndex, $centralCellIndex);
    }

    /**
     * @param CellNeighbours $surroundingCells
     * @return bool
     */
    public function isOvercrowded(CellNeighbours $surroundingCells) : bool
    {
        return $surroundingCells->hasMoreAliveNeighboursThan(3);
    }

    /**
     * @param CellNeighbours $surroundingCells
     * @return bool
     */
    public function isUnderpopulated(CellNeighbours $surroundingCells) : bool
    {
        return $surroundingCells->hasLessAliveNeighboursThan(2);
    }

    /**
     * @param CellNeighbours $surroundingCells
     * @return bool
     */
    public function isAbleToRevive(CellNeighbours $surroundingCells) : bool
    {
        return $surroundingCells->hasExactNumberOfAliveNeighboursEquals(3);
    }
}
