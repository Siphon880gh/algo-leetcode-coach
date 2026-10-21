<?php
declare(strict_types=1);

return [
    'title' => 'Merge BSTs to Create Single BST: unique top, attach, bound-check',
    'leetcode' => 1932,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: pick the only root that is not a leaf elsewhere, attach trees at matching leaves during a bounded DFS, and require all trees used. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'related_guide' => 'merge-bsts-to-create-single-bst',
    'tags' => ['tree', 'binary-search-tree', 'hash-table', 'dfs', 'step-by-step'],
];
