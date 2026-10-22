<?php
declare(strict_types=1);

return [
    'title' => 'Minimize the Total Price of the Trips: count visits, then tree DP',
    'leetcode' => 2646,
    'difficulty' => 'Hard',
    'summary' => 'The paths in a tree are fixed, so first count how often each node is visited over all trips. Then choose non-adjacent nodes to halve with a tree DP: each node is either halved (children full) or full (children free).',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'tree', 'depth-first-search', 'graph', 'leetcode'],
    'related_session' => 'minimize-the-total-price-of-the-trips',
];
