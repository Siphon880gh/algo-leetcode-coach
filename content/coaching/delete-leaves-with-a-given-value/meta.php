<?php
declare(strict_types=1);

return [
    'title' => 'Delete Leaves With a Given Value: prune children first',
    'leetcode' => 1325,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: prune both subtrees, then remove the node if it is now a leaf holding the target, so deletions cascade upward. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'related_guide' => 'delete-leaves-with-a-given-value',
    'tags' => ['tree', 'dfs', 'step-by-step'],
];
