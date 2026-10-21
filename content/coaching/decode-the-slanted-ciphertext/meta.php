<?php
declare(strict_types=1);

return [
    'title' => 'Decode the Slanted Ciphertext: diagonals, then trim',
    'leetcode' => 2075,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: cols = len / rows, read down-right diagonals from each top cell, strip only trailing spaces. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Simulation',
    'topic' => 'LeetCode · Simulation',
    'related_guide' => 'decode-the-slanted-ciphertext',
    'tags' => ['simulation', 'string', 'matrix', 'step-by-step'],
];
