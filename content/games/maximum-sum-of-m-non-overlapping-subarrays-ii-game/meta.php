<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Sum of M Non-Overlapping Subarrays II',
    'leetcode' => 3957,
    'difficulty' => 'Hard',
    'summary' => 'Same DP, but n is 10^5. For layer j, dp[j−1][i−L] − P[i−L] over L in [l, r] is a sliding-window maximum, so keep a monotonic deque per layer, and use the Aliens trick (a per-subarray penalty) to avoid the m layers.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-sum-of-m-non-overlapping-subarrays-ii',
    'related_session' => 'maximum-sum-of-m-non-overlapping-subarrays-ii',
];
