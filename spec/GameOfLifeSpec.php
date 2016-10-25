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
        $this->beConstructedWith([]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(GameOfLife::class);
    }

    function it_should_return_next_generation_for_empty_board()
    {
        $this->calculateNextGeneration();
        $this->currentBoard()->shouldReturn([]);
        $this->generation()->shouldReturn(2);
    }

    function it_should_return_next_generation_for_one_alive_cell()
    {
        $this->beConstructedWith([false, true, false]);
        $this->calculateNextGeneration();

        $this->currentBoard()->shouldReturn(
            [false, false, false]
        );
    }
}
