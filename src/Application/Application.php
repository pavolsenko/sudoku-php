<?php
declare(strict_types = 1);

namespace PhpSudoku\Application;

use PhpSudoku\Puzzle\Puzzle;
use PhpSudoku\Viewer\ViewerInterface;

class Application
{
    private $viewer;
    private $puzzle;

    public function __construct(ViewerInterface $viewer, Puzzle $puzzle)
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