<?php

namespace Unit\Generator;

use PHPUnit\Framework\TestCase;
use SudokuPhp\Generator\BruteForceGenerator;
use SudokuPhp\Helper\PuzzleHelper;

class BruteForceGeneratorTest extends TestCase
{
    private BruteForceGenerator $bruteForceGenerator;

    public function setUp(): void
    {
        parent::setUp();

        $this->bruteForceGenerator = new BruteForceGenerator(new PuzzleHelper());
    }

    public function test_it_should_create_a_valid_puzzle()
    {
        $puzzle = $this->bruteForceGenerator->generate();

        $this->assertCount(
            9,
            $puzzle->getGrid()[rand(0, 8)],
        );
    }
}
