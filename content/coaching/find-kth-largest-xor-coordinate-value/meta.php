<?php
declare(strict_types=1);

return [
    'title' => 'Find Kth Largest XOR Coordinate Value: 2D prefix XOR',
    'leetcode' => 1738,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: P[i + 1][j + 1] = P[i][j + 1] ^ P[i + 1][j] ^ P[i][j] ^ matrix[i][j]; collect all values and select the kth largest. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'related_guide' => 'find-kth-largest-xor-coordinate-value',
    'tags' => ['prefix-sum', 'bit-manipulation', 'matrix', 'step-by-step'],
];
