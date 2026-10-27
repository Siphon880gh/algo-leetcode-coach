<?php
declare(strict_types=1);

return [
    'title' => 'Strange Printer: let the last letter ride on an earlier equal print',
    'leetcode' => 664,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][j] = turns to print s[i to j]. Start with dp[i][j−1] + 1. For every k with s[k] == s[j], the print of s[k] can extend to j: dp[i][k] + dp[k+1][j−1].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'strange-printer',
    'related_session' => 'strange-printer',
];
