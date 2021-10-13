<?php
declare(strict_types = 1);

namespace SudokuPhp\Application;

use SudokuPhp\Puzzle\SudokuPuzzle;
use SudokuPhp\Viewer\ViewerInterface;

class Application
{
    private ViewerInterface $viewer;
    private SudokuPuzzle $puzzle;

    public function __construct(ViewerInterface $viewer, SudokuPuzzle $puzzle)
    {
        $this->viewer = $viewer;
        $this->puzzle = $puzzle;
    }

    public function run(): void
    {
        $this->puzzle->create();

        echo $this->viewer->view($this->puzzle);
    }
}
