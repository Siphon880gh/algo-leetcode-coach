<?php
declare(strict_types=1);

return [
    'title' => 'Reorder Array to Get Same BST: interleave subtrees',
    'leetcode' => 1569,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: root first; split into left and right keeping order; ways = C(n − 1, |left|) · ways(left) · ways(right); subtract 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'number-of-ways-to-reorder-array-to-get-same-bst',
    'tags' => ['math', 'combinatorics', 'divide-and-conquer', 'step-by-step'],
];
