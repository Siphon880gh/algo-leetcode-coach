<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Flips in Binary Tree to Get Result: two costs per node',
    'leetcode' => 2313,
    'difficulty' => 'Hard',
    'summary' => 'Post-order DFS returning (cost to make the node false, cost to make it true). Leaves cost 0 or 1; NOT swaps its child’s pair; OR, AND and XOR take the cheapest combination of child costs giving each value.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['tree', 'depth-first-search', 'dynamic-programming', 'binary-tree', 'leetcode'],
    'related_session' => 'minimum-flips-in-binary-tree-to-get-result',
];
