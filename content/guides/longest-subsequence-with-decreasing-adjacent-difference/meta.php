<?php
declare(strict_types=1);

return [
    'title' => 'Longest Subsequence With Decreasing Adjacent Difference: DP by value and last difference',
    'leetcode' => 3409,
    'difficulty' => 'Med',
    'summary' => 'Values are at most 300. dp[v][d] = longest subsequence ending in value v whose last difference is at least d. A new element v extends the best sequence ending in v − d or v + d with last difference ≥ d.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'longest-subsequence-with-decreasing-adjacent-difference',
];
