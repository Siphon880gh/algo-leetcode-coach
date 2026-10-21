<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways to Reorder Array to Get Same BST: interleavings',
    'leetcode' => 1569,
    'difficulty' => 'Hard',
    'summary' => 'The root must come first. Left and right subtree sequences can interleave freely: ways(a) = C(n − 1, |left|) · ways(left) · ways(right). Subtract 1 for the original order.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'combinatorics', 'divide-and-conquer', 'leetcode'],
    'related_session' => 'number-of-ways-to-reorder-array-to-get-same-bst',
];
