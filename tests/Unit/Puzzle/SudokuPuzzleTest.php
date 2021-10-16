<?php

namespace Unit\Puzzle;

use PHPUnit\Framework\TestCase;
use SudokuPhp\Generator\BacktrackGenerator;
use SudokuPhp\Helper\PuzzleHelper;
use SudokuPhp\Puzzle\SudokuPuzzle;

class SudokuPuzzleTest extends TestCase
{
    private SudokuPuzzle $sudokuPuzzle;

    public function setUp(): void
    {
        parent::setUp();
        $this->sudokuPuzzle = new SudokuPuzzle(
            new BacktrackGenerator(
                new PuzzleHelper(),
            ),
            new PuzzleHelper(),
        );
    }

    public function test_it_creates_a_sudoku_puzzle(): void
    {
        $this->sudokuPuzzle->create();

        $this->assertCount(
            9,
            $this->sudokuPuzzle->getFullGrid()->getGrid(),
        );

        $this->assertCount(
            9,
            $this->sudokuPuzzle->getFullGrid()->getGrid()[rand(0, 8)],
        );
    }
}
