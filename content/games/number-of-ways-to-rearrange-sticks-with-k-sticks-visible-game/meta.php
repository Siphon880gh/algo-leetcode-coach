<?php
declare(strict_types=1);

return [
    'title' => 'Rearrange Sticks with k Visible: place the shortest stick',
    'leetcode' => 1866,
    'difficulty' => 'Hard',
    'summary' => 'dp[n][k]: put the shortest stick first (it is visible: dp[n−1][k−1]) or anywhere else, hidden behind a taller one ((n − 1) · dp[n−1][k]).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-ways-to-rearrange-sticks-with-k-sticks-visible',
    'related_session' => 'number-of-ways-to-rearrange-sticks-with-k-sticks-visible',
];
