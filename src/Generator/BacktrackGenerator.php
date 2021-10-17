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
        $this->sudokuGrid = new SudokuGrid($this->puzzleHelper->createEmptyGrid());
    }

    public function generate(): SudokuGrid
    {
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

            $isValidNumber = $this->puzzleHelper->isValidNumber(
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
}
