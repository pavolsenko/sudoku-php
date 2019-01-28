<?php
declare(strict_types = 1);

namespace PhpSudoku\Viewer;

use PhpSudoku\Puzzle\Puzzle;

class CommandLineViewer implements ViewerInterface
{
    private const LINE_SET = [
        ["┌", "┬", "┐"],
        ["├", "┼", "┤"],
        ["└", "┴", "┘"],
    ];

    private const LINE_TOP = 0;
    private const LINE_MIDDLE = 1;
    private const LINE_BOTTOM = 2;

    public function view(Puzzle $puzzle): string
    {
        $puzzle = $puzzle->getFullGrid();

        $result = $this->drawLine(self::LINE_TOP);

        for ($row = 0; $row < 9; $row++) {
            if ($row > 0 && $row % 3 === 0) {
                $result .= $this->drawLine(self::LINE_MIDDLE);
            }

            $result .= "│ ";

            for ($column = 0; $column < 9; $column++) {
                $result .= $puzzle[$row][$column];

                if ($column % 3 === 2) {
                    $result .= " │ ";
                    continue;
                }

                $result .= " ";
            }

            $result .= "\n";
        }

        $result .= $this->drawLine(self::LINE_BOTTOM);

        return $result;
    }

    private function drawLine(int $type): string
    {
        $result = "";

        for ($i = 0; $i < 25; $i++) {
            if ($i === 0) {
                $result .= self::LINE_SET[$type][0];
                continue;
            }

            if ($i === 24) {
                $result .= self::LINE_SET[$type][2];
                continue;
            }

            if ($i % 8 === 0) {
                $result .= self::LINE_SET[$type][1];
                continue;
            }

            $result .= "─";
        }

        return $result . "\n";
    }
}