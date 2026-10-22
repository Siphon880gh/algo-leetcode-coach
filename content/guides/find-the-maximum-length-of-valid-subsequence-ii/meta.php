<?php
declare(strict_types=1);

return [
    'title' => 'Find the Maximum Length of Valid Subsequence II: DP on the last two remainders',
    'leetcode' => 3202,
    'difficulty' => 'Med',
    'summary' => 'A valid subsequence alternates two remainders mod k. dp[p][v] is the longest one ending in remainder v whose previous remainder is p; each value extends dp[v][p].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'find-the-maximum-length-of-valid-subsequence-ii',
];
