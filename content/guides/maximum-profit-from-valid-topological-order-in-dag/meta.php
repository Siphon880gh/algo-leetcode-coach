<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Profit from Valid Topological Order in DAG: bitmask DP over placed nodes',
    'leetcode' => 3530,
    'difficulty' => 'Hard',
    'summary' => 'With n ≤ 22, dp[mask] is the best profit after placing the nodes in mask; the next node goes at position popcount(mask) + 1 and is allowed once all its predecessors are in mask.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'graph', 'topological-sort', 'array', 'dynamic-programming', 'bitmask', 'leetcode'],
    'related_session' => 'maximum-profit-from-valid-topological-order-in-dag',
];
