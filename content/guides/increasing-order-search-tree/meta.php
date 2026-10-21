<?php
declare(strict_types=1);

return [
    'title' => 'Increasing Order Search Tree: relink during an in-order walk',
    'leetcode' => 897,
    'difficulty' => 'Easy',
    'summary' => 'An in-order walk visits BST nodes in sorted order. Keep a tail pointer from a dummy node; at each node clear its left link and hang it on tail.right.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'binary-search-tree', 'depth-first-search', 'leetcode'],
    'related_session' => 'increasing-order-search-tree',
];
