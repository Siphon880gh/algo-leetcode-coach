<?php
declare(strict_types=1);

return [
    'title' => 'K-th Smallest Remaining Even Integer in Subarray Queries: binary search the answer',
    'leetcode' => 3911,
    'difficulty' => 'Hard',
    'summary' => 'The answer is 2m for the smallest m with m − (removed evens ≤ 2m) ≥ k. nums is sorted, so removed evens ≤ X is a bisect plus a prefix count of evens, and m lies in [k, k + length].',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['array', 'leetcode'],
    'related_session' => 'k-th-smallest-remaining-even-integer-in-subarray-queries',
];
