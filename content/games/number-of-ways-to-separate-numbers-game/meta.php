<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways to Separate Numbers: the last number decides',
    'leetcode' => 1977,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][j] = ways where the last number is num[i..j]. It may not start with 0. It extends any split whose previous number num[k..i−1] is ≤ num[i..j] (compare length, then digits).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-ways-to-separate-numbers',
    'related_session' => 'number-of-ways-to-separate-numbers',
];
