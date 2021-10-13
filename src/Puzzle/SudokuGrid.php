<?php

namespace SudokuPhp\Puzzle;

use InvalidArgumentException;

class SudokuGrid
{
    private array $grid;
    private string $note;

    public function __construct(?array $grid = [])
    {
        $this->grid = $grid;
    }

    public function set(array $grid): SudokuGrid
    {
        if (!$this->isValidSudokuGrid($grid)) {
            throw new InvalidArgumentException('Supported grid is not a valid 9x9 array');
        }

        $this->grid = $grid;
        return $this;
    }

    public function get(): array
    {
        return $this->grid;
    }

    public function setNote(string $note): SudokuGrid
    {
        $this->note = $note;
        return $this;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    private function isValidSudokuGrid(array $grid): bool
    {
        if (!$grid) {
            return false;
        }



        return true;
    }
}
