<?php

namespace Unit\Helper;

use SudokuPhp\Helper\PuzzleHelper;
use PHPUnit\Framework\TestCase;

class PuzzleHelperTest extends TestCase
{
    public const VALID_FULL_SUDOKU_GRID = [
        [1, 7, 9, 5, 2, 8, 3, 4, 6],
        [6, 3, 4, 7, 9, 1, 2, 5, 8],
        [8, 2, 5, 3, 6, 4, 9, 7, 1],
        [4, 9, 6, 8, 3, 5, 1, 2, 7],
        [5, 1, 3, 9, 7, 2, 8, 6, 4],
        [7, 8, 2, 4, 1, 6, 5, 9, 3],
        [2, 4, 8, 1, 5, 7, 6, 3, 9],
        [9, 6, 7, 2, 8, 3, 4, 1, 5],
        [3, 5, 1, 6, 4, 9, 7, 8, 2],
    ];

    public const VALID_PARTIAL_SUDOKU_GRID = [
        [3, 5, 1, 6, 4, 9, 7, 8, 2],
        [6, 3, 4, 7, 9, 1, 2, 5, 8],
        [8, 2, 5, 3, 6, 4, 9, 7, 1],
        [4, 9, 6, 8, 3, 5, 1, 2, 7],
        [5, 1, 3, 9, 7, 2, null, null, null],
        [null, null, null, null, null, null, null, null, null],
        [null, null, null, null, null, null, null, null, null],
        [null, null, null, null, null, null, null, null, null],
        [null, null, null, null, null, null, null, null, null],
    ];

    public const EMPTY_SUDOKU_GRID = [
        [null, null, null, null, null, null, null, null, null],
        [null, null, null, null, null, null, null, null, null],
        [null, null, null, null, null, null, null, null, null],
        [null, null, null, null, null, null, null, null, null],
        [null, null, null, null, null, null, null, null, null],
        [null, null, null, null, null, null, null, null, null],
        [null, null, null, null, null, null, null, null, null],
        [null, null, null, null, null, null, null, null, null],
        [null, null, null, null, null, null, null, null, null],
    ];

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

        $this->assertEquals(
            self::EMPTY_SUDOKU_GRID,
            $emptyPuzzle,
        );
    }

    public function test_it_should_verify_next_number_is_valid_in_a_grid()
    {
        $this->assertTrue(
            $this->puzzleHelper->isValidNumber(
                8,
                self::VALID_PARTIAL_SUDOKU_GRID,
                4,
                6,
            ),
        );
    }

    public function test_it_should_verify_next_number_is_invalid_in_a_grid()
    {
        $this->assertFalse(
            $this->puzzleHelper->isValidNumber(
                9,
                self::VALID_PARTIAL_SUDOKU_GRID,
                4,
                6,
            ),
        );

        $this->assertFalse(
            $this->puzzleHelper->isValidNumber(
                5,
                self::VALID_PARTIAL_SUDOKU_GRID,
                4,
                6,
            ),
        );
    }
}
