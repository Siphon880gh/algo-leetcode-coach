<?php
declare(strict_types=1);

return [
    'title' => 'Construct String from Binary Tree: keep only the parentheses you need',
    'leetcode' => 606,
    'difficulty' => 'Med',
    'summary' => 'Preorder: value, then (left), then (right). Drop the empty pair for a missing right child, and for a missing left child only when the right is missing too.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'dfs', 'strings', 'binary-tree', 'leetcode'],
    'related_session' => 'construct-string-from-binary-tree',
];
