<?php
declare(strict_types=1);

return [
    'title' => 'Count Nodes Equal to Sum of Descendants: post-order sums',
    'leetcode' => 1973,
    'difficulty' => 'Med',
    'summary' => 'Post-order DFS returns each subtree\'s total. At a node, the descendants\' sum is left total + right total; compare with the node value, then return that plus the value.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'kind' => 'algo',
    'tags' => ['tree', 'dfs', 'binary-tree', 'leetcode'],
    'related_session' => 'count-nodes-equal-to-sum-of-descendants',
];
