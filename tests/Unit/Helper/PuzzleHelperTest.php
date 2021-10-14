<?php

namespace Unit\Helper;

use SudokuPhp\Helper\PuzzleHelper;
use PHPUnit\Framework\TestCase;

class PuzzleHelperTest extends TestCase
{
    private PuzzleHelper $puzzleHelper;

    public function setUp(): void
    {
        parent::setUp();

        $this->puzzleHelper = new PuzzleHelper();
    }

    public function test_it_should_create_empty_puzzle_of_size_9_by_9()
    {
        $emptyPuzzle = $this->puzzleHelper->createEmptyGrid()->getGrid();

        for ($i = 0; $i < 9; $i++) {
            for ($j = 0; $j < 9; $j++) {
                $this->assertNull(
                    $emptyPuzzle[$i][$j],
                );
            }
        }

        $this->assertCount(
            9,
            $emptyPuzzle,
        );

        $this->assertCount(
            9,
            $emptyPuzzle[rand(0, 8)],
        );
    }
}
