<?php
declare(strict_types=1);

return [
    'title' => 'First Day in All the Rooms: bounce back, then come again',
    'leetcode' => 1997,
    'difficulty' => 'Med',
    'summary' => 'dp[i] = first day you reach room i. Reaching i+1 means visiting i twice: dp[i+1] = dp[i] + 1 (bounce to nextVisit[i]) + (dp[i] − dp[nextVisit[i]]) (walk back to i) + 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'first-day-where-you-have-been-in-all-the-rooms',
    'related_session' => 'first-day-where-you-have-been-in-all-the-rooms',
];
