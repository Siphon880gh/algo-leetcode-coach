<?php
declare(strict_types=1);

return [
    'title' => 'Palindromic Path Queries in a Tree: XOR masks on an Euler tour',
    'leetcode' => 3841,
    'difficulty' => 'Hard',
    'summary' => 'A path can be rearranged into a palindrome when at most one letter has an odd count. Let m[u] be the XOR of letter bits from the root to u. The path mask is m[u] ⊕ m[v] ⊕ bit(lca). An update changes m on a whole subtree, which is a range XOR on the Euler tour, handled by a Fenwick tree.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'tree', 'depth-first-search', 'segment-tree', 'array', 'string', 'divide-and-conquer', 'leetcode'],
    'related_session' => 'palindromic-path-queries-in-a-tree',
];
