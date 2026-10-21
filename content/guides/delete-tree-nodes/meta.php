<?php
declare(strict_types=1);

return [
    'title' => 'Delete Tree Nodes: post-order sums and counts',
    'leetcode' => 1273,
    'difficulty' => 'Med',
    'summary' => 'Build child lists and run a post-order DFS that returns (sum, count) for each subtree. A subtree whose sum is 0 reports count 0, which removes it from its parent\'s count.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'kind' => 'algo',
    'tags' => ['tree', 'dfs', 'leetcode'],
    'related_session' => 'delete-tree-nodes',
];
