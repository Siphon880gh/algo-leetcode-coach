<?php
declare(strict_types=1);

return [
    'title' => 'Largest Color Value in a Directed Graph: topological DP per colour',
    'leetcode' => 1857,
    'difficulty' => 'Hard',
    'summary' => 'Kahn\'s algorithm detects cycles. Along the topological order, dp[v][c] = most nodes of colour c on any path ending at v; push each node\'s counts to its successors and add its own colour when popped.',
    'category' => 'LeetCode',
    'subcategory' => 'Topological Sort',
    'topic' => 'LeetCode · Topological Sort',
    'kind' => 'algo',
    'tags' => ['topological-sort', 'dynamic-programming', 'graph', 'leetcode'],
    'related_session' => 'largest-color-value-in-a-directed-graph',
];
