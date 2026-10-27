<?php
declare(strict_types=1);

return [
    'title' => 'Subsequences With Equal GCD: track both gcds',
    'leetcode' => 3336,
    'difficulty' => 'Hard',
    'summary' => 'dp[g1][g2] = ways with seq1 gcd g1 and seq2 gcd g2 (0 = empty). Each number goes to seq1, seq2, or neither. Answer: the sum of dp[g][g] for g at least 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-the-number-of-subsequences-with-equal-gcd',
    'related_session' => 'find-the-number-of-subsequences-with-equal-gcd',
];
