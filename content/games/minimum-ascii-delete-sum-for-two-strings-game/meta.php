<?php
declare(strict_types=1);

return [
    'title' => 'Minimum ASCII Delete Sum: pay for every letter you drop',
    'leetcode' => 712,
    'difficulty' => 'Med',
    'summary' => 'dp[i][j] = cheapest deletions to equalize s1[0..i) and s2[0..j). Equal letters: dp[i−1][j−1]. Otherwise min(dp[i−1][j] + s1[i−1], dp[i][j−1] + s2[j−1]) in ASCII.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-ascii-delete-sum-for-two-strings',
    'related_session' => 'minimum-ascii-delete-sum-for-two-strings',
];
