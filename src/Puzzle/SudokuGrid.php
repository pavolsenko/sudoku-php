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

    public function setGrid(array $grid): SudokuGrid
    {
        if (!$this->isValidGrid($grid)) {
            throw new InvalidArgumentException('Supported grid is not a valid 9x9 array');
        }

        $this->grid = $grid;
        return $this;
    }

    public function setGridRow(int $rowNumber, array $row): SudokuGrid
    {
        if ($rowNumber < 0 || $rowNumber > 8) {
            throw new InvalidArgumentException('Invalid row number - sudoku row must be 0-8');
        }

        if (!$row || count($row) !== 9) {
            throw new InvalidArgumentException('Invalid row provided');
        }

        $this->grid[$rowNumber] = $row;
        return $this;
    }

    public function setGridItem(int $rowNumber, int $columnNumber, ?int $item): SudokuGrid
    {
        if ($rowNumber < 0 || $rowNumber > 8) {
            throw new InvalidArgumentException('Invalid row number - sudoku row must be 0-8');
        }

        if ($columnNumber < 0 || $columnNumber > 8) {
            throw new InvalidArgumentException('Invalid column number - sudoku row must be 0-8');
        }

        if ($item && ($item < 1 || $item > 9)) {
            throw new InvalidArgumentException('Invalid item - sudoku item must be 1-9');
        }

        $this->grid[$rowNumber][$columnNumber] = $item;
        return $this;
    }

    public function getGrid(): array
    {
        return $this->grid;
    }

    public function getGridItem(int $rowNumber, int $columnNumber): ?int
    {
        if ($rowNumber < 0 || $rowNumber > 8) {
            throw new InvalidArgumentException('Invalid row number - sudoku row must be 0-8');
        }

        if ($columnNumber < 0 || $columnNumber > 8) {
            throw new InvalidArgumentException('Invalid column number - sudoku row must be 0-8');
        }

        return $this->grid[$rowNumber][$columnNumber];
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

    private function isValidGrid(array $grid): bool
    {
        if (!$grid) {
            return false;
        }



        return true;
    }
}
