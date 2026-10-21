<?php
declare(strict_types=1);

return [
    'title' => 'Domino and Tromino Tiling: include the half-filled states',
    'leetcode' => 790,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: track full boards and boards with one half-filled column, which collapses to dp[n] = 2 · dp[n − 1] + dp[n − 3]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'domino-and-tromino-tiling',
    'tags' => ['dynamic-programming', 'math', 'step-by-step'],
];
