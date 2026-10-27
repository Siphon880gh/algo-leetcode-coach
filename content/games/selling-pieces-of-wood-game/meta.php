<?php
declare(strict_types=1);

return [
    'title' => 'Selling Pieces of Wood: sell whole or cut once',
    'leetcode' => 2312,
    'difficulty' => 'Hard',
    'summary' => 'dp[h][w] = best money for an h times w piece = max(price of that exact shape, best horizontal cut dp[i][w] + dp[h−i][w], best vertical cut dp[h][j] + dp[h][w−j]).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'selling-pieces-of-wood',
    'related_session' => 'selling-pieces-of-wood',
];
