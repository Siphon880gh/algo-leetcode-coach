<?php
declare(strict_types=1);

return [
    'title' => 'Domino and Tromino Tiling: dp[n] = 2 · dp[n − 1] + dp[n − 3]',
    'leetcode' => 790,
    'difficulty' => 'Med',
    'summary' => 'Count tilings of a 2 × n board. Tracking full boards and boards with one cell sticking out leads to the recurrence dp[n] = 2 · dp[n − 1] + dp[n − 3], with dp[0] = 1, dp[1] = 1, dp[2] = 2.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'math', 'leetcode'],
    'related_session' => 'domino-and-tromino-tiling',
];
