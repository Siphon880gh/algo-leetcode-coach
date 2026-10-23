<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Spanning Tree Stability with Upgrades: binary search plus union-find',
    'leetcode' => 3600,
    'difficulty' => 'Hard',
    'summary' => 'Binary search the stability S. Must edges all need strength ≥ S. Then join every optional edge with s ≥ S for free, and edges with 2s ≥ S using upgrades; S works if the graph connects using at most k upgrades.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['greedy', 'union-find', 'graph', 'binary-search', 'minimum-spanning-tree', 'leetcode'],
    'related_session' => 'maximize-spanning-tree-stability-with-upgrades',
];
