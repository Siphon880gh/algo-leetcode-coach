<?php
declare(strict_types=1);

return [
    'title' => 'Longest String Chain: drop one letter to find the predecessor',
    'leetcode' => 1048,
    'difficulty' => 'Med',
    'summary' => 'Sort by length. dp[w] = 1 + max dp[w with one letter removed] over removals that are words.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'longest-string-chain',
    'related_session' => 'longest-string-chain',
];
