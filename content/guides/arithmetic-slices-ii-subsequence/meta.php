<?php
declare(strict_types=1);

return [
    'title' => 'Arithmetic Slices II: per-index map of difference → count of chains',
    'leetcode' => 446,
    'difficulty' => 'Hard',
    'summary' => 'Count arithmetic subsequences of length at least 3. f[i][d] = number of subsequences of length ≥ 2 ending at i with difference d. For each j < i with d = nums[i] − nums[j]: add f[j][d] to the answer, then f[i][d] += f[j][d] + 1. [2,4,6,8,10] → 7. [7,7,7,7,7] → 16. Not 413 (contiguous).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'hash-table', 'arrays', 'leetcode'],
    'related_session' => 'arithmetic-slices-ii-subsequence',
];
