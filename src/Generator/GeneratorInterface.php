<?php
declare(strict_types = 1);

namespace SudokuPhp\Generator;

use SudokuPhp\Puzzle\SudokuGrid;

interface GeneratorInterface
{
    public function generate(): SudokuGrid;
}
