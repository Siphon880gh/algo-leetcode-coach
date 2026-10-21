<?php
declare(strict_types=1);

return [
    'title' => 'Selling Pieces of Wood: DP over every rectangle',
    'leetcode' => 2312,
    'difficulty' => 'Hard',
    'summary' => 'dp[h][w] is the best for an h × w piece: its own price if sold whole, or the best horizontal cut dp[i][w] + dp[h − i][w] or vertical cut dp[h][j] + dp[h][w − j]. Fill it from small to large.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'memoization', 'leetcode'],
    'related_session' => 'selling-pieces-of-wood',
];
