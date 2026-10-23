<?php
declare(strict_types=1);

return [
    'title' => 'Restore the Array: how many ways to cut the digits?',
    'leetcode' => 1416,
    'difficulty' => 'Hard',
    'summary' => 'dp[i] = ways to split s[i..]. A number s[i..j] is valid if it has no leading zero and is ≤ k: dp[i] = Σ dp[j+1] over valid j.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'restore-the-array',
    'related_session' => 'restore-the-array',
];
