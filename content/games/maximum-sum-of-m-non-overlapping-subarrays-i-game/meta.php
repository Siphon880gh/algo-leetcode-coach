<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Sum of M Non-Overlapping Subarrays I',
    'leetcode' => 3956,
    'difficulty' => 'Hard',
    'summary' => 'dp[j][i] = best sum of exactly j subarrays inside the first i elements. Either skip element i, or end a subarray at i of length L in [l, r]: dp[j−1][i−L] + P[i] − P[i−L]. Take the best over j = 1..m at i = n. O(n·m·(r − l)) fits n ≤ 1000.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-sum-of-m-non-overlapping-subarrays-i',
    'related_session' => 'maximum-sum-of-m-non-overlapping-subarrays-i',
];
