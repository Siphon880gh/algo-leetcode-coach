<?php
declare(strict_types=1);

return [
    'title' => 'Find Mode in Binary Search Tree: inorder makes equal values adjacent',
    'leetcode' => 501,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: most frequent values in a BST with duplicates. Inorder gives sorted order, so equal values form runs. Track prev, the run count, and the best; reset the list on a new best, append on a tie. [1,null,2,2] → [2]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['trees', 'binary-search-tree', 'dfs', 'step-by-step'],
    'related_guide' => 'find-mode-in-binary-search-tree',
];
