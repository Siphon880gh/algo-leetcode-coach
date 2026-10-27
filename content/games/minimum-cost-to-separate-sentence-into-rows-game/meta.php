<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Separate Sentence: the last row is free',
    'leetcode' => 2052,
    'difficulty' => 'Med',
    'summary' => 'dp[i] = least cost to lay out words i.. . If they all fit in one row, dp[i] = 0. Otherwise try every first row i to j that fits: (k − row length)² + dp[j + 1].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-cost-to-separate-sentence-into-rows',
    'related_session' => 'minimum-cost-to-separate-sentence-into-rows',
];
