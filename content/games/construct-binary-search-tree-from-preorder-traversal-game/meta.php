<?php
declare(strict_types=1);

return [
    'title' => 'BST From Preorder: build with an upper bound',
    'leetcode' => 1008,
    'difficulty' => 'Med',
    'summary' => 'Recursively take the next value as the root if it is below the current bound; build the left subtree with bound = root, then the right with the parent\'s bound.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'construct-binary-search-tree-from-preorder-traversal',
    'related_session' => 'construct-binary-search-tree-from-preorder-traversal',
];
