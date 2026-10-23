<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Array Sum: halve, subtract, both, or neither',
    'leetcode' => 3366,
    'difficulty' => 'Med',
    'summary' => 'dp[a][b] = least sum so far using a halvings and b subtractions. For each number try the four combos (when both, pick the better order). Answer: min over a ≤ op1, b ≤ op2.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-array-sum',
    'related_session' => 'minimum-array-sum',
];
