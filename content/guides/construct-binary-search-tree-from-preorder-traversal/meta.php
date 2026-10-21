<?php
declare(strict_types=1);

return [
    'title' => 'Construct Binary Search Tree from Preorder Traversal: build with an upper bound',
    'leetcode' => 1008,
    'difficulty' => 'Med',
    'summary' => 'Read preorder left to right. Each call builds a subtree whose values are below a bound: take the next value as the root if it fits, build its left subtree with the root as the new bound, then its right subtree with the old bound.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'binary-search-tree', 'stack', 'recursion', 'leetcode'],
    'related_session' => 'construct-binary-search-tree-from-preorder-traversal',
];
