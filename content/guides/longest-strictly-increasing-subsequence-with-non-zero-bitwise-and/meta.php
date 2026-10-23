<?php
declare(strict_types=1);

return [
    'title' => 'Longest Strictly Increasing Subsequence With Non-Zero Bitwise AND: one LIS per bit',
    'leetcode' => 3825,
    'difficulty' => 'Med',
    'summary' => 'A non-zero AND means every chosen number shares some bit. For each bit, take the numbers that have it and run the usual O(n log n) LIS; return the best.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['array', 'bit-manipulation', 'leetcode'],
    'related_session' => 'longest-strictly-increasing-subsequence-with-non-zero-bitwise-and',
];
