<?php
declare(strict_types=1);

return [
    'title' => 'Solving Questions With Brainpower: solve and skip ahead, or move on',
    'leetcode' => 2140,
    'difficulty' => 'Med',
    'summary' => 'dp[i] = best from question i on = max(dp[i+1], points[i] + dp[i + brainpower[i] + 1]).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'solving-questions-with-brainpower',
    'related_session' => 'solving-questions-with-brainpower',
];
