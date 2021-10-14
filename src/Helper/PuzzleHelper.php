<?php
declare(strict_types = 1);

namespace SudokuPhp\Helper;

use SudokuPhp\Puzzle\SudokuGrid;

class PuzzleHelper
{
    public function createEmptyGrid(): SudokuGrid
    {
        $grid = [];

        for ($row = 0; $row < 9; $row++) {
            for ($column = 0; $column < 9; $column++) {
                $grid[$row][$column] = null;
            }
        }

        return new SudokuGrid($grid);
    }
}
