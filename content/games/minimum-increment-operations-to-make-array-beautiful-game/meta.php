<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Increment Operations: every window of 3 needs a big one',
    'leetcode' => 2919,
    'difficulty' => 'Med',
    'summary' => 'dp[i] = least cost with nums[i] raised to at least k and every window up to i covered = max(0, k − nums[i]) + min(dp[i−1], dp[i−2], dp[i−3]). Answer: min of the last three.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-increment-operations-to-make-array-beautiful',
    'related_session' => 'minimum-increment-operations-to-make-array-beautiful',
];
