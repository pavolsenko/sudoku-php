<?php
declare(strict_types = 1);

namespace PhpSudoku\Viewer;

use PhpSudoku\Puzzle\Puzzle;

class HtmlViewer implements ViewerInterface
{
    public function view(Puzzle $puzzle): string
    {
        return "<html lang='en'></html>";
    }
}