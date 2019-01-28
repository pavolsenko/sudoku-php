<?php
declare(strict_types = 1);

namespace PhpSudoku;

require __DIR__ . '/../vendor/autoload.php';

use PhpSudoku\Application\Application;
use PhpSudoku\Generator\BacktrackGenerator;
use PhpSudoku\Puzzle\Puzzle;
use PhpSudoku\Viewer\CommandLineViewer;
use PhpSudoku\Viewer\HtmlViewer;

if (php_sapi_name() === "cli") {
    $viewer = new CommandLineViewer();
} else {
    $viewer = new HtmlViewer();
}

$generator = new BacktrackGenerator();
$puzzle = new Puzzle($generator);

$application = new Application(
    $viewer,
    $puzzle
);

$application->run();
