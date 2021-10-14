<?php

namespace SudokuPhp\Generator;

use SudokuPhp\Helper\PuzzleHelper;
use SudokuPhp\Puzzle\SudokuGrid;

class BacktrackGenerator implements GeneratorInterface
{
    private SudokuGrid $sudokuGrid;
    private PuzzleHelper $puzzleHelper;

    public function __construct(PuzzleHelper $puzzleHelper)
    {
        $this->puzzleHelper = $puzzleHelper;
        $this->sudokuGrid = new SudokuGrid();
    }

    public function generate(): SudokuGrid
    {
        $this->sudokuGrid = $this->puzzleHelper->createEmptyGrid();
        $this->sudokuGrid = $this->sudokuGrid->setGridRow(
            0,
            $this->puzzleHelper->generateRandomNiner(),
        );

        $this->addNextNumberToPuzzle(
            $this->sudokuGrid->getGrid(),
            1,
            0,
        );

        return $this->sudokuGrid;
    }

    /**
     * Recursively adds numbers to the puzzle, returns true if the puzzle is complete.
     */
    private function addNextNumberToPuzzle(array $grid, int $row, int $column): bool
    {
        if ($row === 9) {
            $this->sudokuGrid = $this->sudokuGrid->setGrid($grid);
            return true;
        }

        $randomNiner = $this->puzzleHelper->generateRandomNiner();

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
        }

        return false;
    }

    private function isValidNumber(int $number, array $grid, int $row, int $column): bool
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
