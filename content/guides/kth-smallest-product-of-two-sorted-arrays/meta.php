<?php
declare(strict_types=1);

return [
    'title' => 'Kth Smallest Product of Two Sorted Arrays: binary search the value',
    'leetcode' => 2040,
    'difficulty' => 'Hard',
    'summary' => 'Binary search the product value x. For each a in nums1, count b in nums2 with a · b ≤ x using bisect: b ≤ floor(x / a) for a > 0, b ≥ ceil(x / a) for a < 0, all or none for a = 0. The smallest x with count ≥ k is the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['binary-search', 'sorting', 'math', 'leetcode'],
    'related_session' => 'kth-smallest-product-of-two-sorted-arrays',
];
