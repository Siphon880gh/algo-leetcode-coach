<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Time to Break Locks I: bitmask DP over broken locks',
    'leetcode' => 3376,
    'difficulty' => 'Med',
    'summary' => 'The factor depends only on how many locks are already broken: x = 1 + k · count. dp[mask] = least time to break the locks in mask; breaking lock j next takes ⌈strength[j] / x⌉ minutes.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'array', 'dynamic-programming', 'backtracking', 'bitmask', 'leetcode'],
    'related_session' => 'minimum-time-to-break-locks-i',
];
