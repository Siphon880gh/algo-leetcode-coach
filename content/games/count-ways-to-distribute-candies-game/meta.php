<?php
declare(strict_types=1);

return [
    'title' => 'Count Ways to Distribute Candies: Stirling numbers',
    'leetcode' => 1692,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][j] = ways to put i candies in j non-empty unlabeled bags = dp[i−1][j−1] (new bag) + j · dp[i−1][j] (join one of j bags).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-ways-to-distribute-candies',
    'related_session' => 'count-ways-to-distribute-candies',
];
