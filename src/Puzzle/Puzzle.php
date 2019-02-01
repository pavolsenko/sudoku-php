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
    }

    public function solve(): void
    {

    }
}