<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Balanced Subsequence Sum',
    'leetcode' => 2926,
    'difficulty' => 'Hard',
    'summary' => 'The condition is nums[i] − i non-decreasing along the subsequence. dp[i] = nums[i] + max(0, best dp[j] with key[j] ≤ key[i]) — a Fenwick max over compressed keys.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'tags' => ['range-tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-balanced-subsequence-sum',
    'related_session' => 'maximum-balanced-subsequence-sum',
];
