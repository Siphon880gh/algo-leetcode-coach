<?php
declare(strict_types=1);

return [
    'title' => 'Sum of K Subarrays With Length at Least M: layer DP with a running best',
    'leetcode' => 3473,
    'difficulty' => 'Med',
    'summary' => 'dp[j][i] is the best sum of j subarrays inside the first i elements. A new subarray ending at i starts at some t ≤ i − m, worth dp[j − 1][t] + pre[i] − pre[t]; keep the best dp[j − 1][t] − pre[t] as i grows.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'prefix-sum', 'leetcode'],
    'related_session' => 'sum-of-k-subarrays-with-length-at-least-m',
];
