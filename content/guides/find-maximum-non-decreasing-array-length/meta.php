<?php
declare(strict_types=1);

return [
    'title' => 'Find Maximum Non-decreasing Array Length: shortest last segment',
    'leetcode' => 2945,
    'difficulty' => 'Hard',
    'summary' => 'Split nums into segments with non-decreasing sums. dp[i] = most segments for the first i items, using the latest j with pre[j] + last[j] ≤ pre[i], which also keeps the last segment smallest. A monotonic queue finds j.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'dynamic-programming', 'prefix-sum', 'monotonic-queue', 'monotonic-stack', 'stack', 'queue', 'leetcode'],
    'related_session' => 'find-maximum-non-decreasing-array-length',
];
