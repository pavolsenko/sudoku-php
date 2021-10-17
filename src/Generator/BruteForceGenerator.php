<?php
declare(strict_types = 1);

namespace SudokuPhp\Generator;

use SudokuPhp\Helper\PuzzleHelper;
use SudokuPhp\Puzzle\SudokuGrid;

class BruteForceGenerator implements GeneratorInterface
{
    private PuzzleHelper $puzzleHelper;

    public function __construct(PuzzleHelper $puzzleHelper)
    {
        $this->puzzleHelper = $puzzleHelper;
        $this->sudokuGrid = new SudokuGrid($this->puzzleHelper->createEmptyGrid());
    }

    /**
     * Bruteforce a Sudoku puzzle
     */
    public function generate(): SudokuGrid
    {
        $this->sudokuGrid = $this->sudokuGrid->setGridRow(0, $this->puzzleHelper->generateRandomNiner());

        $iterations = 0;
        $row = 1;

        while ($row < 9) {
            $iterations++;

            $nextRow = $this->puzzleHelper->generateRandomNiner();

            $isValidRow = true;
            for ($i = 0; $i < 9; $i++) {
                $isValidNumber = $this->puzzleHelper->isValidNumber(
                    $nextRow[$i],
                    $this->sudokuGrid->getGrid(),
                    $row,
                    $i,
                );

                if (!$isValidNumber) {
                    $isValidRow = false;
                    break;
                }
            }

            if ($isValidRow) {
                $this->sudokuGrid = $this->sudokuGrid->setGridRow($row, $nextRow);
                $row++;
            }
        }

        $this->sudokuGrid->setNote('Number of iteration to generate (bruteforce): ' . $iterations);

        return $this->sudokuGrid;
    }
}
