<?php
declare(strict_types = 1);

namespace PhpSudoku\Helper;

class PuzzleHelper
{
    public function createEmptyPuzzle(): array
    {
        $puzzle = [];

        for ($row = 0; $row < 9; $row++) {
            for ($column = 0; $column < 9; $column++) {
                $puzzle[$row][$column] = null;
            }
        }

        return $puzzle;
    }
}