<?php

namespace spec\Madkom;

use Madkom\GameOfLife;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class GameOfLifeSpec
 * @package spec\Madkom
 * @mixin GameOfLife
 */
class GameOfLifeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith([[]]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(GameOfLife::class);
    }

    function it_should_return_next_generation_for_empty_board()
    {
        $this->calculateNextGeneration();
        $this->currentBoard()->shouldReturn([[]]);
        $this->generation()->shouldReturn(2);
    }

    function it_should_survive_two_cells_as_having_two_neighbours()
    {
        $initWithBoard = [
            [true, true, true, true]
        ];
        $nextGenerationBoard = [
            [false, true, true, false]
        ];

        $this->generateNextGeneration($initWithBoard, $nextGenerationBoard);
    }

    function it_should_kill_cells_because_of_underpopulation_for_two_dimensions()
    {
        $initWithBoard = [
            [true, true, false, true],
            [false, false, true, false]
        ];
        $nextGenerationBoard = [
            [false, true, false, false],
            [false, false, true, false]
        ];

        $this->generateNextGeneration($initWithBoard, $nextGenerationBoard);
    }

    function it_should_kill_cells_because_of_overcrodwing()
    {
        $initWithBoard = [
            [true,  true, true],
            [false, true, true,]
        ];
        $nextGenerationBoard = [
            [true,  false, true],
            [false, false, true]
        ];

        $this->generateNextGeneration($initWithBoard, $nextGenerationBoard);
    }

    /**
     * @param $initWithBoard
     * @param $nextGenerationBoard
     */
    public function generateNextGeneration($initWithBoard, $nextGenerationBoard):void
    {
        $this->beConstructedWith($initWithBoard);
        $this->calculateNextGeneration();
        $this->currentBoard()->shouldReturn($nextGenerationBoard);
    }
}