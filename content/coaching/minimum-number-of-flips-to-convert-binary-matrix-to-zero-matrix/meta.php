<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Flips to Convert Binary Matrix to Zero Matrix: BFS over masks',
    'leetcode' => 1284,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: encode the tiny matrix as a bitmask, precompute each cell\'s flip mask (itself and neighbours), and BFS with XOR moves until the mask is 0. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'BFS',
    'topic' => 'LeetCode · BFS',
    'related_guide' => 'minimum-number-of-flips-to-convert-binary-matrix-to-zero-matrix',
    'tags' => ['bfs', 'bit-manipulation', 'matrix', 'step-by-step'],
];
