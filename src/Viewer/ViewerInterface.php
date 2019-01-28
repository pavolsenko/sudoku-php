<?php
declare(strict_types = 1);

namespace PhpSudoku\Viewer;

use PhpSudoku\Puzzle\Puzzle;

interface ViewerInterface
{
    public function view(Puzzle $puzzle): string;
}
