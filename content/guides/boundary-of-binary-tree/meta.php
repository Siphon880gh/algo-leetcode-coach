<?php
declare(strict_types=1);

return [
    'title' => 'Boundary of Binary Tree: root, left edge, leaves, reversed right edge',
    'leetcode' => 545,
    'difficulty' => 'Med',
    'summary' => 'Return the root, then the left boundary (prefer left child, else right, excluding the leaf), then all leaves from left to right, then the right boundary reversed (prefer right child, else left, excluding the leaf). The root counts once and is not a leaf. [1,null,2,3,4] → [1,3,4,2].',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'dfs', 'leetcode'],
    'related_session' => 'boundary-of-binary-tree',
];
