<?php
declare(strict_types=1);

return [
    'title' => 'Longest Increasing Subsequence II: max segment tree over values',
    'leetcode' => 2407,
    'difficulty' => 'Hard',
    'summary' => 'Let dp[v] be the longest valid subsequence ending with value v. For each x, dp[x] = 1 + the largest dp on values x − k … x − 1, which a segment tree over values answers in O(log V).',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'kind' => 'algo',
    'tags' => ['array', 'divide-and-conquer', 'dynamic-programming', 'binary-indexed-tree', 'segment-tree', 'queue', 'monotonic-queue', 'leetcode'],
    'related_session' => 'longest-increasing-subsequence-ii',
];
