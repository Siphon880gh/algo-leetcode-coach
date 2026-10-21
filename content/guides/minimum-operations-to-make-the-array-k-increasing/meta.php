<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Make the Array K-Increasing: k chains, longest non-decreasing',
    'leetcode' => 2111,
    'difficulty' => 'Hard',
    'summary' => 'The condition only links indices with the same remainder mod k. For each of the k chains, keep its longest non-decreasing subsequence and change the rest: chain length minus LNDS, summed.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['binary-search', 'longest-increasing-subsequence', 'array', 'leetcode'],
    'related_session' => 'minimum-operations-to-make-the-array-k-increasing',
];
