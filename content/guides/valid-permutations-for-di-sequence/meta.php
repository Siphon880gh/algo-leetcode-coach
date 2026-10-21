<?php
declare(strict_types=1);

return [
    'title' => 'Valid Permutations for DI Sequence: DP on the rank of the last element',
    'leetcode' => 903,
    'difficulty' => 'Hard',
    'summary' => 'Only the relative order of the numbers placed so far matters. dp[i][j] counts valid prefixes of length i + 1 whose last element is the j-th smallest; "I" sums ranks below j, "D" sums ranks at or above j, using prefix sums.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'prefix-sum', 'leetcode'],
    'related_session' => 'valid-permutations-for-di-sequence',
];
