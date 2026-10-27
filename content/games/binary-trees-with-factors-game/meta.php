<?php
declare(strict_types=1);

return [
    'title' => 'Binary Trees With Factors: children multiply to the parent',
    'leetcode' => 823,
    'difficulty' => 'Med',
    'summary' => 'Sort. dp[x] = 1 (a leaf) + the sum of dp[a] times dp[x divided by a] over factor pairs a times b = x with both in the array.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'binary-trees-with-factors',
    'related_session' => 'binary-trees-with-factors',
];
