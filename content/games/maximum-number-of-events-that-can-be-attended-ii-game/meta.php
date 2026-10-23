<?php
declare(strict_types=1);

return [
    'title' => 'Max Events Attended II: k picks, sorted by end',
    'leetcode' => 1751,
    'difficulty' => 'Hard',
    'summary' => 'Sort events by end. dp[c][i] = best value using the first i events and at most c attendances = max(skip: dp[c][i−1], take: value + dp[c−1][last event ending before this start]).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-number-of-events-that-can-be-attended-ii',
    'related_session' => 'maximum-number-of-events-that-can-be-attended-ii',
];
