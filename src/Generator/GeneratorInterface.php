<?php
declare(strict_types = 1);

namespace PhpSudoku\Generator;

interface GeneratorInterface
{
    public function generate(): array;
}
