<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Consecutive Elements: each value may grow by 1',
    'leetcode' => 3041,
    'difficulty' => 'Hard',
    'summary' => 'Sort. dp[v] = longest consecutive run ending at value v. For x: dp[x+1] = dp[x] + 1 (use it as x+1), then dp[x] = dp[x−1] + 1 (use it as x). Order matters: update x+1 first.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximize-consecutive-elements-in-an-array-after-modification',
    'related_session' => 'maximize-consecutive-elements-in-an-array-after-modification',
];
