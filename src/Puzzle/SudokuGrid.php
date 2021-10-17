<?php

namespace SudokuPhp\Puzzle;

class SudokuGrid
{
    private array $grid;
    private string $note = '';

    public function __construct(?array $grid = [])
    {
        $this->grid = $grid;
    }

    public function setGrid(array $grid): SudokuGrid
    {
        $this->grid = $grid;
        return $this;
    }

    public function setGridRow(int $rowNumber, array $row): SudokuGrid
    {
        $this->grid[$rowNumber] = $row;
        return $this;
    }

    public function setGridItem(int $rowNumber, int $columnNumber, ?int $item): SudokuGrid
    {
        $this->grid[$rowNumber][$columnNumber] = $item;
        return $this;
    }

    public function getGrid(): array
    {
        return $this->grid;
    }

    public function getGridItem(int $rowNumber, int $columnNumber): ?int
    {
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
}
