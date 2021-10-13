<?php
declare(strict_types = 1);

use SudokuPhp\Helper\PuzzleHelper;
use PHPUnit\Framework\TestCase;

class PuzzleHelperTest extends TestCase
{
    private PuzzleHelper $puzzleHelper;

    public function setUp(): void
    {
        parent::setUp();

        $this->puzzleHelper = new PuzzleHelper();
    }

    public function test_it_should_create_empty_puzzle_of_size_9_by_9()
    {
        $emptyPuzzle = $this->puzzleHelper->createEmptyPuzzle();

        for ($i = 0; $i < 20; $i++) {
            $this->assertNull(
                $emptyPuzzle->get()[rand(0, 8)][rand(0, 8)]
            );
        }

        $this->assertCount(
            9,
            $emptyPuzzle->get()
        );

        $this->assertCount(
            9,
            $emptyPuzzle->get()[rand(0, 8)]
        );
    }
}
