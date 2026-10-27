<?php
declare(strict_types=1);

return [
    'title' => 'Count Partitions With Max-Min Difference at Most K',
    'leetcode' => 3578,
    'difficulty' => 'Med',
    'summary' => 'dp[i] = ways to cut the first i elements. The last segment can start anywhere from L(i) to i−1, where L(i) is the leftmost start whose max − min at most k (two monotonic deques find it). So dp[i] = dp[L] + … + dp[i−1], a prefix-sum range.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'tags' => ['sliding-window', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-partitions-with-max-min-difference-at-most-k',
    'related_session' => 'count-partitions-with-max-min-difference-at-most-k',
];
