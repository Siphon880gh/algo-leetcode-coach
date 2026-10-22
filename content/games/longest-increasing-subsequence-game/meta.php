<?php
declare(strict_types=1);

return [
    'title' => 'Longest Increasing Subsequence: extend the best smaller ending',
    'leetcode' => 300,
    'difficulty' => 'Med',
    'summary' => 'dp[i] = 1 + max dp[j] over earlier j with nums[j] < nums[i] (or 1 if none). The answer is the max dp value, not dp[n−1].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'longest-increasing-subsequence',
    'related_session' => 'longest-increasing-subsequence',
];
