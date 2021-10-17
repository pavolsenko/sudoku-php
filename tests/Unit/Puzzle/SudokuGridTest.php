<?php

namespace Unit\Puzzle;

use PHPUnit\Framework\TestCase;
use SudokuPhp\Helper\PuzzleHelper;
use SudokuPhp\Puzzle\SudokuGrid;

class SudokuGridTest extends TestCase
{
    private SudokuGrid $sudokuGrid;

    public function setUp(): void
    {
        parent::setUp();
        $this->sudokuGrid = new SudokuGrid();
    }

    public function test_setting_a_note(): void
    {
        $this->assertEmpty(
            $this->sudokuGrid->getNote(),
        );

        $this->sudokuGrid->setNote('this is a test note');

        $this->assertEquals(
            'this is a test note',
            $this->sudokuGrid->getNote(),
        );
    }
}
