<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Work Sessions to Finish the Tasks: subset DP',
    'leetcode' => 1986,
    'difficulty' => 'Med',
    'summary' => 'n ≤ 14. Precompute which subsets fit in one session; dp[mask] = min sessions to finish mask = min over fitting submasks s of dp[mask ^ s] + 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Bitmask DP',
    'topic' => 'LeetCode · Bitmask DP',
    'kind' => 'algo',
    'tags' => ['bitmask', 'dynamic-programming', 'leetcode'],
    'related_session' => 'minimum-number-of-work-sessions-to-finish-the-tasks',
];
