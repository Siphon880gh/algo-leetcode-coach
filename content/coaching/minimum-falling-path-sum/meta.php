<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Falling Path Sum: three parents per cell',
    'leetcode' => 931,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: each cell adds the smallest of the up to three cells above it; fill row by row and take the minimum of the last row. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'minimum-falling-path-sum',
    'tags' => ['dynamic-programming', 'matrix', 'step-by-step'],
];
