<?php
declare(strict_types=1);

return [
    'title' => 'Longest Arithmetic Subsequence: map per index',
    'leetcode' => 1027,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: for each pair i < j, extend the length stored at i for difference nums[j] − nums[i] into j. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'longest-arithmetic-subsequence',
    'tags' => ['dynamic-programming', 'hash-table', 'arrays', 'step-by-step'],
];
