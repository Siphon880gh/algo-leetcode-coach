<?php
declare(strict_types=1);

return [
    'title' => 'Increasing Order Search Tree: relink in order',
    'leetcode' => 897,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: an in-order walk visits nodes in sorted order; hang each on tail.right, clear its left link, and return dummy.right. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'increasing-order-search-tree',
    'tags' => ['trees', 'binary-search-tree', 'depth-first-search', 'step-by-step'],
];
