<?php
declare(strict_types=1);

return [
    'title' => 'Longest Balanced Subarray II: lazy segment tree over left ends',
    'leetcode' => 3721,
    'difficulty' => 'Hard',
    'summary' => 'For the current right end r, let f(l) = distinct odds − distinct evens in [l, r]. Adding nums[r] changes f by ±1 on (previous occurrence, r]. Neighboring f values differ by at most 1, so the leftmost l with f(l) = 0 is found by walking down nodes whose range [min, max] contains 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'kind' => 'algo',
    'tags' => ['segment-tree', 'array', 'hash-table', 'divide-and-conquer', 'prefix-sum', 'leetcode'],
    'related_session' => 'longest-balanced-subarray-ii',
];
