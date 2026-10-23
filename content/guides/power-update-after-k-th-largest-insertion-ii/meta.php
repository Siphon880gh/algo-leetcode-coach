<?php
declare(strict_types=1);

return [
    'title' => 'Power Update After K-th Largest Insertion II: Fenwick tree over compressed values',
    'leetcode' => 3930,
    'difficulty' => 'Hard',
    'summary' => 'Read every value up front, compress, and keep counts in a Fenwick tree. After each insertion, walk the tree to find the k-th largest x and set p = p^x mod 10^9 + 7 by fast power.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Indexed Tree',
    'topic' => 'LeetCode · Binary Indexed Tree',
    'kind' => 'algo',
    'tags' => ['segment-tree', 'array', 'hash-table', 'math', 'sorting', 'leetcode'],
    'related_session' => 'power-update-after-k-th-largest-insertion-ii',
];
