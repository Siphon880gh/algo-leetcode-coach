<?php
declare(strict_types=1);

return [
    'title' => 'Find Duplicate Subtrees: serialize in postorder',
    'leetcode' => 652,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: build a key for each subtree from its children\'s keys, count the keys, and report on the second sighting. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'find-duplicate-subtrees',
    'tags' => ['trees', 'dfs', 'hash-table', 'binary-tree', 'step-by-step'],
];
