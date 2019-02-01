<?php
declare(strict_types=1);

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
        for ($row = 0; $row < 9; $row++) {
            for ($column = 0; $column < 9; $column++) {

                $shouldNumberBeVisible = $this->shouldNumberBeVisible(
                    $row,
                    $column,
                    $difficulty
                );

                if ($shouldNumberBeVisible) {
                    $this->gameGrid[$row][$column] = $this->fullGrid[$row][$column];
                    continue;
                }

                $this->gameGrid[$row][$column] = null;
            }
        }
    }

    private function shouldNumberBeVisible(int $row, int $column, int $difficulty): bool
    {
        if ($difficulty === self::DIFFICULTY_EASY) {
            $difficultyDividerConstant = 3;
            $maxNumbersPerSquare = 6;
        }

        if ($difficulty === self::DIFFICULTY_MEDIUM) {
            $difficultyDividerConstant = 4;
            $maxNumbersPerSquare = 5;
        }

        if ($difficulty === self::DIFFICULTY_HARD) {
            $difficultyDividerConstant = 5;
            $maxNumbersPerSquare = 4;
        }

        $makeNUmbreVisible = rand(0, 81) % $difficultyDividerConstant === 0;
        if ($makeNUmbreVisible) {
            return true;
        }

        return false;
    }

    private function isSolvable(): bool
    {
        return false;
    }

    public function solve(): void
    {

    }
}