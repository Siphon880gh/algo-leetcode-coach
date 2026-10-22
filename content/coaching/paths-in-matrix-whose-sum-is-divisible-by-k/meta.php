<?php
declare(strict_types=1);

return [
    'title' => 'Paths in Matrix Whose Sum Is Divisible by K: remainder DP, start at grid[0][0] mod k, mod 10^9 + 7',
    'leetcode' => 2435,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: count paths per cell and remainder instead of listing paths, seed the start with its own value, and keep counts mod 10^9 + 7. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'paths-in-matrix-whose-sum-is-divisible-by-k',
    'tags' => ['array', 'dynamic-programming', 'matrix', 'step-by-step'],
];
