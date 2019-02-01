<?php
declare(strict_types = 1);

namespace PhpSudoku\Puzzle;

use PhpSudoku\Generator\GeneratorInterface;
use PhpSudoku\Helper\PuzzleHelper;

class Puzzle
{
    private const DIFFICULTY_EASY = 0;
    private const DIFFICULTY_MEDIUM = 1;
    private const DIFFICULTY_HARD = 2;

    private $generator;
    private $puzzleHelper;

    private $gameGrid;
    private $fullGrid;

    public function __construct(GeneratorInterface $generator, PuzzleHelper $puzzleHelper)
    {
        $this->generator = $generator;
        $this->puzzleHelper = $puzzleHelper;

    }

    public function getGameGrid(): array
    {
        return $this->gameGrid;
    }

    public function getFullGrid(): array
    {
        return $this->fullGrid;
    }

    public function create(): void
    {

        $this->fullGrid = $this->generator->generate();

        while (!$this->isSolvable()) {
            $this->gameGrid = $this->puzzleHelper->createEmptyPuzzle();
            $this->createGame();
            break;
        }
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

    private function isSolvable(): bool
    {
        return false;
    }

    public function solve(): void
    {

    }
}