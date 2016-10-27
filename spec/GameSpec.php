<?php

namespace spec\Madkom;

use Madkom\CellFactory;
use Madkom\Game;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\Builder\CellBuilder;

/**
 * Class GameOfLifeSpec
 * @package spec\Madkom
 * @mixin Game
 */
class GameSpec extends ObjectBehavior
{
    /** @var  CellFactory */
    private $cellFactory;

    function let(CellFactory $cellFactory)
    {
        $cellFactory->create(true)->willReturn(CellBuilder::create(true));
        $cellFactory->create(false)->willReturn(CellBuilder::create(false));
        $this->cellFactory = $cellFactory;

        $this->beConstructedWith([[]]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Game::class);
    }

    function it_should_return_next_generation_for_empty_board()
    {
        $this->calculateNextGeneration($this->cellFactory);
        $this->currentBoard()->shouldReturn([[]]);
        $this->generation()->shouldReturn(2);
    }

    function it_should_survive_two_cells_as_having_two_neighbours()
    {
        $initWithBoard = [
            [CellBuilder::create(true), CellBuilder::create(true), CellBuilder::create(true), CellBuilder::create(true)]
        ];
        $nextGenerationBoard = [
            [CellBuilder::create(false), CellBuilder::create(true), CellBuilder::create(true), CellBuilder::create(false)]
        ];

        $this->generateNextGeneration($initWithBoard, $nextGenerationBoard);
    }

    function it_should_kill_cells_because_of_underpopulation_for_two_dimensions()
    {
        $initWithBoard = [
            [CellBuilder::create(false), CellBuilder::create(true)],
            [CellBuilder::create(true), CellBuilder::create(false)]
        ];
        $nextGenerationBoard = [
            [CellBuilder::create(false), CellBuilder::create(false)],
            [CellBuilder::create(false), CellBuilder::create(false)]
        ];

        $this->generateNextGeneration($initWithBoard, $nextGenerationBoard);
    }

    function it_should_kill_cells_because_of_overcrowding()
    {
        $initWithBoard = [
            [CellBuilder::create(true), CellBuilder::create(true), CellBuilder::create(false), CellBuilder::create(true)],
            [CellBuilder::create(true), CellBuilder::create(true), CellBuilder::create(true), CellBuilder::create(false)]
        ];
        $nextGenerationBoard = [
            [CellBuilder::create(true), CellBuilder::create(false), CellBuilder::create(false), CellBuilder::create(false)],
            [CellBuilder::create(true), CellBuilder::create(false), CellBuilder::create(true), CellBuilder::create(false)]
        ];

        $this->generateNextGeneration($initWithBoard, $nextGenerationBoard);
    }

    function it_should_revive_dead_cell_if_there_are_3_live_neighbours()
    {
        $initWithBoard = [
            [CellBuilder::create(true),  CellBuilder::create(false), CellBuilder::create(true)],
            [CellBuilder::create(false), CellBuilder::create(true), CellBuilder::create(false)]
        ];
        $nextGenerationBoard = [
            [CellBuilder::create(false),  CellBuilder::create(true), CellBuilder::create(false)],
            [CellBuilder::create(false), CellBuilder::create(true), CellBuilder::create(false)]
        ];

        $this->generateNextGeneration($initWithBoard, $nextGenerationBoard);
    }

    function it_should_kill_cells_for_3_lines_by_overcrowding()
    {
        $initWithBoard = [
            [CellBuilder::create(true), CellBuilder::create(true)],
            [CellBuilder::create(true), CellBuilder::create(true)],
            [CellBuilder::create(true), CellBuilder::create(true)],
        ];
        $nextGenerationBoard = [
            [CellBuilder::create(true), CellBuilder::create(true)],
            [CellBuilder::create(false), CellBuilder::create(false)],
            [CellBuilder::create(true), CellBuilder::create(true)]
        ];

        $this->generateNextGeneration($initWithBoard, $nextGenerationBoard);
    }

    /**
     * @param $initWithBoard
     * @param $nextGenerationBoard
     */
    public function generateNextGeneration($initWithBoard, $nextGenerationBoard) : void
    {
        $this->beConstructedWith($initWithBoard);
        $this->calculateNextGeneration($this->cellFactory);
        $this->currentBoard()->shouldReturn($nextGenerationBoard);
    }
}