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

    /**
     * Generates a random combination of 9 numbers from 1 to 9
     */
    public function generateRandomNiner(): array
    {
        $startNiner = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        $resultNiner = [];

        while (count($startNiner) > 0) {
            $randomIndex = rand(0, count($startNiner) - 1);
            $resultNiner[] = $startNiner[$randomIndex];

            unset($startNiner[$randomIndex]);
            $startNiner = array_values($startNiner);
        }

        return $resultNiner;
    }

    public function isValidNumber(int $number, array $grid, int $row, int $column): bool
    {
        for ($i = 0; $i < 9; $i++) {
            if ($grid[$row][$i] === $number) {
                return false;
            }

            if ($grid[$i][$column] === $number) {
                return false;
            }
        }

        $sectorRow = 3 * ((int)($row / 3));
        $sectorColumn = 3 * ((int)($column / 3));

        $row1 = ($row + 2) % 3;
        $row2 = ($row + 4) % 3;

        $column1 = ($column + 2) % 3;
        $column2 = ($column + 4) % 3;

        if ($grid[$row1 + $sectorRow][$column1 + $sectorColumn] === $number) {
            return false;
        }

        if ($grid[$row2 + $sectorRow][$column1 + $sectorColumn] === $number) {
            return false;
        }

        if ($grid[$row1 + $sectorRow][$column2 + $sectorColumn] === $number) {
            return false;
        }

        if ($grid[$row2 + $sectorRow][$column2 + $sectorColumn] === $number) {
            return false;
        }

        return true;
    }
}
