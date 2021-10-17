<?php

namespace SudokuPhp\Puzzle;

use SudokuPhp\Generator\GeneratorInterface;
use SudokuPhp\Helper\PuzzleHelper;

class SudokuPuzzle
{
    private const DIFFICULTY_EASY = 0;
    private const DIFFICULTY_MEDIUM = 1;
    private const DIFFICULTY_HARD = 2;

    private GeneratorInterface $generator;
    private PuzzleHelper $puzzleHelper;

    private SudokuGrid $gameGrid;
    private SudokuGrid $fullGrid;

    public function __construct(GeneratorInterface $generator, PuzzleHelper $puzzleHelper)
    {
        $this->generator = $generator;
        $this->puzzleHelper = $puzzleHelper;
        $this->gameGrid = new SudokuGrid($this->puzzleHelper->createEmptyGrid());
    }

    public function getGameGrid(): SudokuGrid
    {
        return $this->gameGrid;
    }

    public function getFullGrid(): SudokuGrid
    {
        return $this->fullGrid;
    }

    public function create(?int $difficulty = self::DIFFICULTY_EASY): void
    {
        $this->fullGrid = $this->generator->generate();
        $this->createGame($difficulty);
    }

    private function createGame(int $difficulty): void
    {
        $randomPremiumNumbers = [];

        if ($difficulty === self::DIFFICULTY_EASY) {
            $difficultyDividerConstant = 6;
            $randomPremiumNumbers = [
                rand(1, 2) => 9,
                rand(3, 4) => 9,
                rand(5, 6) => 9,
                rand(7, 9) => 9,
            ];
        }

        if ($difficulty === self::DIFFICULTY_MEDIUM) {
            $difficultyDividerConstant = 7;
            $randomPremiumNumbers = [
                rand(1, 9) => 8,
            ];
        }

        if ($difficulty === self::DIFFICULTY_HARD) {
            $difficultyDividerConstant = 8;
            $randomPremiumNumbers = [
                rand(1, 9) => 7,
            ];
        }

        for ($row = 0; $row < 9; $row++) {
            for ($column = 0; $column < 9; $column++) {
                $currentNumber = $this->fullGrid->getGridItem($row, $column);
                $premiumVisibility = false;
                $isPremiumNumber = array_key_exists($currentNumber, $randomPremiumNumbers);

                if ($isPremiumNumber) {
                    if ($randomPremiumNumbers[$currentNumber] > 0) {
                        $premiumVisibility = true;
                        $randomPremiumNumbers[$this->fullGrid->getGridItem($row, $column)]--;
                    }
                }

                $randomVisibility = rand(0, 100) % $difficultyDividerConstant === 0;

                $shouldNumberBeVisible = $premiumVisibility || $randomVisibility;

                if ($shouldNumberBeVisible) {
                    $this->gameGrid = $this->gameGrid->setGridItem(
                        $row,
                        $column,
                        $this->fullGrid->getGridItem($row, $column),
                    );
                    continue;
                }

                $this->gameGrid = $this->gameGrid->setGridItem($row, $column, null);
            }
        }
    }

    public function solve(): void
    {
        // TODO: implement solving algorithm
    }
}
