<?php
declare(strict_types=1);

return [
    'title' => 'Largest 1-Bordered Square: run lengths left and up',
    'leetcode' => 1139,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: for each cell store the run of 1s ending there to the left and upward, then treat the cell as a bottom-right corner and try sizes from the largest down. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'largest-1-bordered-square',
    'tags' => ['dynamic-programming', 'matrix', 'prefix-sum', 'step-by-step'],
];
