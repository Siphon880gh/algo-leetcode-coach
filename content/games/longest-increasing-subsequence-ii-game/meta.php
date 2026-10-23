<?php
declare(strict_types=1);

return [
    'title' => 'Longest Increasing Subsequence II',
    'leetcode' => 2407,
    'difficulty' => 'Hard',
    'summary' => 'dp[v] = longest valid subsequence ending with value v. For x, dp[x] = 1 + max(dp over values [x − k, x − 1]) — a range-max segment tree over values.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'tags' => ['range-tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'longest-increasing-subsequence-ii',
    'related_session' => 'longest-increasing-subsequence-ii',
];
