<?php
declare(strict_types=1);

return [
    'title' => 'Transform to Chessboard: validate, then count mismatches',
    'leetcode' => 782,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: check the row and complement pattern and the 1-counts, then count mismatches of the first row and column against 0101… and pick the cheaper valid parity. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'transform-to-chessboard',
    'tags' => ['math', 'bit-manipulation', 'matrix', 'step-by-step'],
];
