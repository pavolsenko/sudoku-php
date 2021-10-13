<?php
declare(strict_types = 1);

namespace SudokuPhp\Viewer;

use SudokuPhp\Puzzle\SudokuPuzzle;

interface ViewerInterface
{
    public function view(SudokuPuzzle $puzzle): string;
}
