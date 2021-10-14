<?php

namespace Unit\Generator;

use PHPUnit\Framework\TestCase;
use SudokuPhp\Generator\BacktrackGenerator;
use SudokuPhp\Helper\PuzzleHelper;

class BacktrackGeneratorTest extends TestCase
{
    private BacktrackGenerator $backtrackGenerator;

    public function setUp(): void
    {
        parent::setUp();

        $this->backtrackGenerator = new BacktrackGenerator(new PuzzleHelper());
    }

    public function test_it_should_create_a_valid_puzzle()
    {
        $puzzle = $this->backtrackGenerator->generate();

        $this->assertCount(
            9,
            $puzzle->getGrid()[rand(0, 8)],
        );
    }
}
