<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Sum of M Non-Overlapping Subarrays I: layered DP with a sliding max',
    'leetcode' => 3956,
    'difficulty' => 'Hard',
    'summary' => 'f_j[i] is the best total of j subarrays inside the first i elements. A new subarray ending at i starts at t in [i − r, i − l], so keep the max of f_{j−1}[t] − P[t] in a monotonic deque.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['queue', 'array', 'binary-search', 'dynamic-programming', 'prefix-sum', 'sliding-window', 'monotonic-queue', 'leetcode'],
    'related_session' => 'maximum-sum-of-m-non-overlapping-subarrays-i',
];
