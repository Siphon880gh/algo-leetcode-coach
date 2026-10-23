<?php
declare(strict_types=1);

return [
    'title' => 'Guess Number II: minimize the worst case of each guess',
    'leetcode' => 375,
    'difficulty' => 'Med',
    'summary' => 'dp[l][r] = money needed to guarantee a win on [l, r]. Try every guess g: g + max(dp[l][g−1], dp[g+1][r]); keep the smallest.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'guess-number-higher-or-lower-ii',
    'related_session' => 'guess-number-higher-or-lower-ii',
];
