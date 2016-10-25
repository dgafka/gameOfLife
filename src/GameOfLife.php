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
    private $board;

    /**
     * GameOfLife constructor.
     * @param array $board
     */
    public function __construct(array $board)
    {
        $this->board = $board;
    }

    public function calculateNextGeneration() : void
    {
        
    }

    /**
     * @return array
     */
    public function currentBoard() : array
    {
        return [];
    }

    /**
     * @return int
     */
    public function generation() : int
    {
        return 2;
    }
}
