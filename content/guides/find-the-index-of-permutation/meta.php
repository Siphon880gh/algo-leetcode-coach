<?php
declare(strict_types=1);

return [
    'title' => 'Find the Index of Permutation: count smaller unused values',
    'leetcode' => 3109,
    'difficulty' => 'Med',
    'summary' => 'At position i, every unused value smaller than perm[i] starts (n − 1 − i)! earlier permutations. Count the smaller unused values with a Fenwick tree and add count · (n − 1 − i)!.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Indexed Tree',
    'topic' => 'LeetCode · Binary Indexed Tree',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'binary-indexed-tree', 'leetcode'],
    'related_session' => 'find-the-index-of-permutation',
];
