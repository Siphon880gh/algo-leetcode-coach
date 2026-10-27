<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Satisfy Conditions: one value per column',
    'leetcode' => 3122,
    'difficulty' => 'Med',
    'summary' => 'Each column becomes a single value and neighbors differ. cost[c][v] = m − (count of v in column c). dp over columns: dp[c][v] = cost + min dp[c−1][u] for u not equal to v.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-number-of-operations-to-satisfy-conditions',
    'related_session' => 'minimum-number-of-operations-to-satisfy-conditions',
];
