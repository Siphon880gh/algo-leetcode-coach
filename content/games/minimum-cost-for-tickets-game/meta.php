<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost for Tickets: which pass covers today?',
    'leetcode' => 983,
    'difficulty' => 'Med',
    'summary' => 'dp[d] = cheapest cost through day d. Non-travel days copy dp[d−1]. Travel days: min(dp[d−1] + 1-day, dp[d−7] + 7-day, dp[d−30] + 30-day), with negatives counting as 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-cost-for-tickets',
    'related_session' => 'minimum-cost-for-tickets',
];
