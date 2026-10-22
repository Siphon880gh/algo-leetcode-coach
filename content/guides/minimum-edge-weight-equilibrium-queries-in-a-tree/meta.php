<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Edge Weight Equilibrium Queries in a Tree: weight counts from the root and LCA',
    'leetcode' => 2846,
    'difficulty' => 'Hard',
    'summary' => 'Weights are 1 … 26, so store for each node how many edges of each weight lie on its root path. A query’s path counts are cnt[a] + cnt[b] − 2·cnt[lca]; keep the most common weight and change the rest.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['array', 'tree', 'graph', 'leetcode'],
    'related_session' => 'minimum-edge-weight-equilibrium-queries-in-a-tree',
];
