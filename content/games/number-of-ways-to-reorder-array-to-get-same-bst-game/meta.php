<?php
declare(strict_types=1);

return [
    'title' => 'Reorder Array for the Same BST: interleave the subtrees',
    'leetcode' => 1569,
    'difficulty' => 'Hard',
    'summary' => 'The root stays first. Left items (smaller) and right items (larger) keep their own relative order but can interleave: ways = C(L + R, L) · ways(left) · ways(right). Subtract 1 for the original order.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-ways-to-reorder-array-to-get-same-bst',
    'related_session' => 'number-of-ways-to-reorder-array-to-get-same-bst',
];
