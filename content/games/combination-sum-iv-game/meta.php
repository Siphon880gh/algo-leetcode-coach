<?php
declare(strict_types=1);

return [
    'title' => 'Combination Sum IV: count by the last number used',
    'leetcode' => 377,
    'difficulty' => 'Med',
    'summary' => 'dp[t] = number of ordered sequences summing to t. dp[0] = 1, and dp[t] = Σ dp[t − x] over every x ≤ t (x is the last number).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'combination-sum-iv',
    'related_session' => 'combination-sum-iv',
];
