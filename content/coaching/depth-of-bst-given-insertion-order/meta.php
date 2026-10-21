<?php
declare(strict_types=1);

return [
    'title' => 'Depth of BST Given Insertion Order: neighbours decide depth',
    'leetcode' => 1902,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: for each inserted value, depth = 1 + max(depth of predecessor, depth of successor) using a sorted set. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Ordered Set',
    'topic' => 'LeetCode · Ordered Set',
    'related_guide' => 'depth-of-bst-given-insertion-order',
    'tags' => ['ordered-set', 'binary-search-tree', 'tree', 'step-by-step'],
];
