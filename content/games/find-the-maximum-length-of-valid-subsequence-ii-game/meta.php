<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Length of Valid Subsequence II: last two remainders',
    'leetcode' => 3202,
    'difficulty' => 'Med',
    'summary' => 'Valid means remainders alternate between two values x, y (mod k). dp[x][y] = longest valid subsequence ending in remainder y whose previous is x: dp[prev][cur] = dp[cur][prev] + 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-the-maximum-length-of-valid-subsequence-ii',
    'related_session' => 'find-the-maximum-length-of-valid-subsequence-ii',
];
