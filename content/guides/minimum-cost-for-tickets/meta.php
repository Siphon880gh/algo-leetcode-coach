<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost For Tickets: DP over calendar days',
    'leetcode' => 983,
    'difficulty' => 'Med',
    'summary' => 'dp[d] is the cheapest way to cover every travel day up to day d. On a non-travel day it equals dp[d − 1]; on a travel day, pick the cheapest of a 1-day, 7-day or 30-day pass ending today.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'arrays', 'leetcode'],
    'related_session' => 'minimum-cost-for-tickets',
];
