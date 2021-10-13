<?php
declare(strict_types=1);

namespace SudokuPhp\Generator;

use SudokuPhp\Helper\PuzzleHelper;
use SudokuPhp\Puzzle\SudokuGrid;

class BacktrackGenerator implements GeneratorInterface
{
    private SudokuGrid $grid;

    private PuzzleHelper $puzzleHelper;

    public function __construct(PuzzleHelper $puzzleHelper)
    {
        $this->puzzleHelper = $puzzleHelper;
    }

    public function generate(): SudokuGrid
    {
        $this->grid = $this->puzzleHelper->createEmptyPuzzle();
        $this->grid[0] = $this->generateRandomNiner();

        $this->addNextNumberToPuzzle(
            $this->grid,
            $row = 1,
            $column = 0,
        );

        return $this->grid;
    }

    /**
     * Generates random combinations of 9 numbers
     *
     * @return array
     */
    private function generateRandomNiner(): array
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

    private function addNextNumberToPuzzle(SudokuGrid $grid, int $row, int $column): bool
    {
        if ($row === 9) {
            $this->grid = $grid;
            return true;
        }

        $randomNiner = $this->generateRandomNiner();
        for ($i = 0; $i < 9; $i++) {
            $nextNumber = $randomNiner[$i];

            $isValidNumber = $this->isValidNumber(
                $nextNumber,
                $grid,
                $row,
                $column
            );

            if (!$isValidNumber) {
                continue;
            }

            $grid[$row][$column] = $nextNumber;

            if ($column == 8) {
                if ($this->addNextNumberToPuzzle($grid, $row + 1, 0)) {
                    return true;
                }
            } else {
                if ($this->addNextNumberToPuzzle($grid, $row, $column + 1)) {
                    return true;
                }
            }
        };

        return false;
    }

    private function isValidNumber(int $number, SudokuGrid $grid, int $row, int $column): bool
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
