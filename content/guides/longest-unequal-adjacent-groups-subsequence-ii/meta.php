<?php
declare(strict_types=1);

return [
    'title' => 'Longest Unequal Adjacent Groups Subsequence II: longest path DP with parents',
    'leetcode' => 2901,
    'difficulty' => 'Med',
    'summary' => 'dp[i] is the longest valid subsequence ending at i: the best dp[j] + 1 over earlier j with a different group, the same length, and Hamming distance 1. Keep parents to rebuild it.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'string', 'dynamic-programming', 'leetcode'],
    'related_session' => 'longest-unequal-adjacent-groups-subsequence-ii',
];
