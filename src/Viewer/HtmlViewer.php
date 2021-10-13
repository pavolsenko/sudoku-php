<?php
declare(strict_types = 1);

namespace SudokuPhp\Viewer;

use SudokuPhp\Puzzle\SudokuPuzzle;

class HtmlViewer implements ViewerInterface
{
    public function view(SudokuPuzzle $puzzle): string
    {
        return "<html lang='en'></html>";
    }
}
