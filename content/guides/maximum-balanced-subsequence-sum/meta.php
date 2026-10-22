<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Balanced Subsequence Sum: key nums[i] − i, prefix maximum',
    'leetcode' => 2926,
    'difficulty' => 'Hard',
    'summary' => 'The condition says nums[i] − i never decreases along the subsequence. dp[i] = nums[i] + best dp among earlier keys ≤ its key; a Fenwick tree of maxima over compressed keys answers that.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'dynamic-programming', 'binary-indexed-tree', 'segment-tree', 'leetcode'],
    'related_session' => 'maximum-balanced-subsequence-sum',
];
