<?php
declare(strict_types = 1);

namespace SudokuPhp\Generator;

use SudokuPhp\Puzzle\SudokuGrid;

class BruteForceGenerator implements GeneratorInterface
{
    public function generate(): SudokuGrid
    {
        return new SudokuGrid();
    }
}
