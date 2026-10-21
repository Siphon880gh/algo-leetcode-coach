<?php
declare(strict_types=1);

return [
    'title' => 'Valid Permutations for DI Sequence: DP on ranks',
    'leetcode' => 903,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: track only the rank of the last placed number; "I" sums smaller previous ranks, "D" sums ranks at or above, with prefix sums for O(n²). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'valid-permutations-for-di-sequence',
    'tags' => ['dynamic-programming', 'prefix-sum', 'step-by-step'],
];
