<?php
declare(strict_types=1);

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
    }

    public function getGameGrid(): SudokuGrid
    {
        return $this->gameGrid;
    }

    public function getFullGrid(): SudokuGrid
    {
        return $this->fullGrid;
    }

    public function create(): void
    {
        $this->fullGrid = $this->generator->generate();
        $this->gameGrid = $this->puzzleHelper->createEmptyPuzzle();
        $this->createGame();
    }

    private function createGame(int $difficulty = self::DIFFICULTY_EASY): void
    {
        if ($difficulty === self::DIFFICULTY_EASY) {
            $difficultyDividerConstant = 6;
            $randomPremiumNumbers = [
                rand(1, 4) => 7,
                rand(5, 9) => 7,
            ];
        }

        if ($difficulty === self::DIFFICULTY_MEDIUM) {
            $difficultyDividerConstant = 7;
            $randomPremiumNumbers = [
                rand(1, 9) => 6,
            ];
        }

        if ($difficulty === self::DIFFICULTY_HARD) {
            $difficultyDividerConstant = 8;
            $randomPremiumNumbers = [
                rand(1, 9) => 5,
            ];
        }

        for ($row = 0; $row < 9; $row++) {
            for ($column = 0; $column < 9; $column++) {
                $currentNumber = $this->fullGrid[$row][$column];
                $premiumVisibility = false;
                $isPremiumNumber = array_key_exists($currentNumber, $randomPremiumNumbers);

                if ($isPremiumNumber) {
                    if ($randomPremiumNumbers[$currentNumber] > 0) {
                        $premiumVisibility = true;
                        $randomPremiumNumbers[$this->fullGrid[$row][$column]]--;
                    }
                }

                $randomVisibility = rand(0, 100) % $difficultyDividerConstant === 0;

                $shouldNumberBeVisible = $premiumVisibility || $randomVisibility;

                if ($shouldNumberBeVisible) {
                    $this->gameGrid[$row][$column] = $this->fullGrid[$row][$column];
                    continue;
                }

                $this->gameGrid[$row][$column] = null;
            }
        }
    }

    public function solve(): void
    {
        // TODO: implement solving algorithm
    }
}
