<?php
declare(strict_types=1);

return [
    'title' => 'Construct Binary Tree from Preorder and Postorder: the second preorder value is the left root',
    'leetcode' => 889,
    'difficulty' => 'Med',
    'summary' => 'pre[0] is the root and pre[1] is the root of the left subtree. Its position in postorder tells you how many nodes the left subtree has, which splits both arrays for the recursion.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'divide-and-conquer', 'hash-table', 'leetcode'],
    'related_session' => 'construct-binary-tree-from-preorder-and-postorder-traversal',
];
