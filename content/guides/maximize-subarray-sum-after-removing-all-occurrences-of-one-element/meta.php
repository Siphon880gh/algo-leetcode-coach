<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Subarray Sum After Removing All Occurrences of One Element: zero out with a segment tree',
    'leetcode' => 3410,
    'difficulty' => 'Hard',
    'summary' => 'Removing every x is the same as setting those positions to 0, as long as the answer is positive. Keep a segment tree of (sum, best prefix, best suffix, best subarray); for each distinct x set its positions to 0, read the root, and restore.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['segment-tree', 'array', 'hash-table', 'divide-and-conquer', 'dynamic-programming', 'prefix-sum', 'leetcode'],
    'related_session' => 'maximize-subarray-sum-after-removing-all-occurrences-of-one-element',
];
