<?php
declare(strict_types=1);

return [
    'title' => 'Count Pairs of Connectable Servers in a Weighted Tree Network: DFS per centre',
    'leetcode' => 3067,
    'difficulty' => 'Med',
    'summary' => 'For each server c, DFS into each neighbour’s subtree and count servers whose distance from c is divisible by signalSpeed. Valid pairs take two servers from different subtrees: (S² − Σ s²) / 2.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['tree', 'depth-first-search', 'array', 'leetcode'],
    'related_session' => 'count-pairs-of-connectable-servers-in-a-weighted-tree-network',
];
