<?php
declare(strict_types=1);

return [
    'title' => 'Delivering Boxes: DP with a monotonic deque',
    'leetcode' => 1687,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: dp[i] = min over valid j of dp[j] + 2 + port changes in boxes j … i − 1; keep j candidates in a deque by dp[j] − changes[j]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'delivering-boxes-from-storage-to-ports',
    'tags' => ['dynamic-programming', 'monotonic-queue', 'prefix-sum', 'step-by-step'],
];
