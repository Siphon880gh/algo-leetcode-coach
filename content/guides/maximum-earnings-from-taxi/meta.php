<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Earnings From Taxi: DP over road points',
    'leetcode' => 2008,
    'difficulty' => 'Med',
    'summary' => 'dp[i] = best earnings on reaching point i. dp[i] = max(dp[i − 1], dp[start] + end − start + tip) over rides ending at i. Group rides by end point.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'array', 'leetcode'],
    'related_session' => 'maximum-earnings-from-taxi',
];
