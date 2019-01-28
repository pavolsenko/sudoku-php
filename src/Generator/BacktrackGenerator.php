<?php
declare(strict_types=1);

namespace PhpSudoku\Generator;

class BacktrackGenerator implements GeneratorInterface
{
    private $puzzle;

    public function generate(): array
    {
        $this->puzzle = $this->resetPuzzle();
        $this->puzzle[0] = $this->generateRandomNiner();

        $this->addNextNumberToPuzzle(
            $this->puzzle,
            $row = 1,
            $column = 0
        );

        return $this->puzzle;
    }

    private function resetPuzzle(): array
    {
        $puzzle = [];

        for ($row = 0; $row < 9; $row++) {
            for ($column = 0; $column < 9; $column++) {
                $puzzle[$row][$column] = null;
            }
        }

        return $puzzle;
    }

    /**
     * Generates random combinations of 9 numbers
     *
     * @return array
     */
    private function generateRandomNiner(): array
    {
        $startNiner = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        $resultNiner = [];

        while (count($startNiner) > 0) {
            $randomIndex = rand(0, count($startNiner) - 1);
            $resultNiner[] = $startNiner[$randomIndex];

            unset($startNiner[$randomIndex]);
            $startNiner = array_values($startNiner);
        }

        return $resultNiner;
    }

    private function addNextNumberToPuzzle(array $puzzle, int $row, int $column): bool
    {
        if ($row === 9) {
            $this->puzzle = $puzzle;
            return true;
        }

        $randomNiner = $this->generateRandomNiner();
        for ($i = 0; $i < 9; $i++) {
            $nextNumber = $randomNiner[$i];

            $isValidNumber = $this->isValidNumber(
                $nextNumber,
                $puzzle,
                $row,
                $column
            );

            if (!$isValidNumber) {
                continue;
            }

            $puzzle[$row][$column] = $nextNumber;

            if ($column == 8) {
                if ($this->addNextNumberToPuzzle($puzzle, $row + 1, 0)) {
                    return true;
                }
            } else {
                if ($this->addNextNumberToPuzzle($puzzle, $row, $column + 1)) {
                    return true;
                }
            }
        };

        return false;
    }

    private function isValidNumber(int $number, array $puzzle, int $row, int $column): bool
    {
        for ($i = 0; $i < 9; $i++) {
            if ($puzzle[$row][$i] === $number) {
                return false;
            }

            if ($puzzle[$i][$column] === $number) {
                return false;
            }
        }

        $sectorRow = 3 * ((int)($row / 3));
        $sectorColumn = 3 * ((int)($column / 3));

        $row1 = ($row + 2) % 3;
        $row2 = ($row + 4) % 3;

        $column1 = ($column + 2) % 3;
        $column2 = ($column + 4) % 3;

        if ($puzzle[$row1 + $sectorRow][$column1 + $sectorColumn] === $number) {
            return false;
        }

        if ($puzzle[$row2 + $sectorRow][$column1 + $sectorColumn] === $number) {
            return false;
        }

        if ($puzzle[$row1 + $sectorRow][$column2 + $sectorColumn] === $number) {
            return false;
        }

        if ($puzzle[$row2 + $sectorRow][$column2 + $sectorColumn] === $number) {
            return false;
        }

        return true;
    }

}