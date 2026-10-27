<?php
declare(strict_types=1);

return [
    'title' => 'Ones and Zeroes: 0-1 knapsack with two budgets',
    'leetcode' => 474,
    'difficulty' => 'Med',
    'summary' => 'dp[z][o] = most strings using at most z zeros and o ones. For each string (zeros c0, ones c1), go backwards: dp[z][o] = max(dp[z][o], dp[z−c0][o−c1] + 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'ones-and-zeroes',
    'related_session' => 'ones-and-zeroes',
];
