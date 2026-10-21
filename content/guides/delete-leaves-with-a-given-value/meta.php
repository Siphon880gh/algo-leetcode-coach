<?php
declare(strict_types=1);

return [
    'title' => 'Delete Leaves With a Given Value: post-order removal',
    'leetcode' => 1325,
    'difficulty' => 'Med',
    'summary' => 'Process children before the parent. After pruning both subtrees, a node that has become a leaf with the target value is removed too, so the deletion cascades upward.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'kind' => 'algo',
    'tags' => ['tree', 'dfs', 'leetcode'],
    'related_session' => 'delete-leaves-with-a-given-value',
];
