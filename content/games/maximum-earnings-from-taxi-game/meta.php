<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Earnings From Taxi: best earnings at each point',
    'leetcode' => 2008,
    'difficulty' => 'Med',
    'summary' => 'dp[p] = best earnings by the time you reach point p = max(dp[p−1], dp[start] + end − start + tip for rides ending at p).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-earnings-from-taxi',
    'related_session' => 'maximum-earnings-from-taxi',
];
