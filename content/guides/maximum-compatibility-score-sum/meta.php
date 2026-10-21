<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Compatibility Score Sum: bitmask DP over mentors',
    'leetcode' => 1947,
    'difficulty' => 'Med',
    'summary' => 'm ≤ 8. Precompute every student–mentor score; dp[mask] = best total when students 0 … popcount(mask) − 1 are matched to the mentors in mask.',
    'category' => 'LeetCode',
    'subcategory' => 'Bitmask DP',
    'topic' => 'LeetCode · Bitmask DP',
    'kind' => 'algo',
    'tags' => ['bitmask', 'dynamic-programming', 'backtracking', 'leetcode'],
    'related_session' => 'maximum-compatibility-score-sum',
];
