<?php
declare(strict_types=1);

return [
    'title' => 'Arithmetic Slices II: per-index map of difference → count of chains',
    'leetcode' => 446,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: count arithmetic subsequences of length ≥ 3. f[i][d] = subsequences of length ≥ 2 ending at i with difference d. For j < i, d = nums[i] − nums[j]: answer += f[j][d]; f[i][d] += f[j][d] + 1. [2,4,6,8,10] → 7. [7,7,7,7,7] → 16. Not 413. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dynamic-programming', 'hash-table', 'arrays', 'step-by-step'],
    'related_guide' => 'arithmetic-slices-ii-subsequence',
];
