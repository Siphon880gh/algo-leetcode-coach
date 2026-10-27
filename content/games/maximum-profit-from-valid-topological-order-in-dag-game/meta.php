<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Profit from Valid Topological Order in DAG',
    'leetcode' => 3530,
    'difficulty' => 'Hard',
    'summary' => 'Bitmask DP: dp[mask] is the best profit with the nodes in mask placed first. A node v can come next only if all its parents are in mask, and it earns score[v] times (|mask| + 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-profit-from-valid-topological-order-in-dag',
    'related_session' => 'maximum-profit-from-valid-topological-order-in-dag',
];
