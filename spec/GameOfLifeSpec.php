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
        $this->beConstructedWith([[true, true, true, true]]);
        $this->calculateNextGeneration();

        $this->currentBoard()->shouldReturn(
            [[false, true, true, false]]
        );
    }

    function it_should_kill_cells_because_of_underpopulation_for_two_dimensions()
    {
        $this->beConstructedWith([
            [true, true, false, true],
            [false, false, true, false]
        ]);

        $this->calculateNextGeneration();

        $this->currentBoard()->shouldReturn([
            [false, true, false, false],
            [false, false, true, false]
        ]);
    }
}
