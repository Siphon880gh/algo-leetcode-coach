<?php
declare(strict_types=1);

return [
    'title' => 'Longest Arithmetic Subsequence: DP keyed by difference',
    'leetcode' => 1027,
    'difficulty' => 'Med',
    'summary' => 'For each index j and each earlier i, the difference nums[j] − nums[i] extends the best sequence with that difference ending at i. Keep one map of difference → length per index.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'hash-table', 'arrays', 'leetcode'],
    'related_session' => 'longest-arithmetic-subsequence',
];
