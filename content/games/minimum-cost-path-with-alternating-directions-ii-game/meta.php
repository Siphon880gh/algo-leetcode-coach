<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost Path with Alternating Directions II',
    'leetcode' => 3603,
    'difficulty' => 'Med',
    'summary' => 'Moves (right or down) alternate with one-second waits, so every cell you pass through except the start and the goal also charges its wait cost. dp[i][j] = (i+1)(j+1) + min(dp[up] + wait[up], dp[left] + wait[left]), with no wait charged on (0,0).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-cost-path-with-alternating-directions-ii',
    'related_session' => 'minimum-cost-path-with-alternating-directions-ii',
];
