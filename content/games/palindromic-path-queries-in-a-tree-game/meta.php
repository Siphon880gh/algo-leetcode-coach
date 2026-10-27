<?php
declare(strict_types=1);

return [
    'title' => 'Palindromic Path Queries in a Tree',
    'leetcode' => 3841,
    'difficulty' => 'Hard',
    'summary' => 'A string can be rearranged into a palindrome when at most one letter has an odd count. Give each node a 26-bit parity mask of the path from the root (Euler tour + Fenwick tree of XORs handles updates); the path u to v has mask(u) ⊕ mask(v) ⊕ bit(lca).',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'palindromic-path-queries-in-a-tree',
    'related_session' => 'palindromic-path-queries-in-a-tree',
];
