<?php
declare(strict_types=1);

return [
    'title' => 'Convert BST to Greater Tree: reverse inorder with a running sum',
    'leetcode' => 538,
    'difficulty' => 'Med',
    'summary' => 'Replace each value with itself plus all larger values. A reverse inorder walk (right, node, left) visits values from largest to smallest; keep a running sum s, add the node value to s, and write s into the node. [0,null,1] → [1,null,1]. Same as 1038.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'binary-search-tree', 'dfs', 'leetcode'],
    'related_session' => 'convert-bst-to-greater-tree',
];
