<?php
declare(strict_types=1);

return [
    'title' => 'Climbing Stairs II',
    'leetcode' => 3693,
    'difficulty' => 'Med',
    'summary' => 'dp[j] = min over i in {j−1, j−2, j−3} (i ≥ 0) of dp[i] + costs[j] + (j − i)². dp[0] = 0; the answer is dp[n].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'climbing-stairs-ii',
    'related_session' => 'climbing-stairs-ii',
];
