<?php
declare(strict_types = 1);

namespace SudokuPhp;

require __DIR__ . '/../vendor/autoload.php';

use SudokuPhp\Application\Application;
use SudokuPhp\Generator\BacktrackGenerator;
use SudokuPhp\Helper\PuzzleHelper;
use SudokuPhp\Puzzle\SudokuPuzzle;
use SudokuPhp\Viewer\CommandLineViewer;
use SudokuPhp\Viewer\HtmlViewer;

if (php_sapi_name() === "cli") {
    $viewer = new CommandLineViewer();
} else {
    $viewer = new HtmlViewer();
}

$puzzleHelper = new PuzzleHelper();
$generator = new BacktrackGenerator($puzzleHelper);
$puzzle = new SudokuPuzzle($generator, $puzzleHelper);

$application = new Application(
    $viewer,
    $puzzle
);

$application->run();
