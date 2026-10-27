<?php
declare(strict_types=1);

return [
    'title' => 'Count the Number of Inversions: insert the next element by rank',
    'leetcode' => 3193,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][c] = permutations of the first i + 1 positions with c inversions. The new element can create 0 to i inversions: dp[i][c] = the sum of dp[i−1][c − t]. If a requirement exists for end i, keep only that c.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-the-number-of-inversions',
    'related_session' => 'count-the-number-of-inversions',
];
