<?php
declare(strict_types=1);

return [
    'title' => 'Minimum XOR Sum of Two Arrays: bitmask DP',
    'leetcode' => 1879,
    'difficulty' => 'Hard',
    'summary' => 'n ≤ 14, so DP over subsets of nums2 already used. dp[mask] = best sum when nums1[0 … popcount(mask) − 1] are matched to the elements of mask.',
    'category' => 'LeetCode',
    'subcategory' => 'Bitmask DP',
    'topic' => 'LeetCode · Bitmask DP',
    'kind' => 'algo',
    'tags' => ['bitmask', 'dynamic-programming', 'bit-manipulation', 'leetcode'],
    'related_session' => 'minimum-xor-sum-of-two-arrays',
];
