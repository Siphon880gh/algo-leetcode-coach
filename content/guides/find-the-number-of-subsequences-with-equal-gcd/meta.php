<?php
declare(strict_types=1);

return [
    'title' => 'Find the Number of Subsequences With Equal GCD: DP on both GCDs',
    'leetcode' => 3336,
    'difficulty' => 'Hard',
    'summary' => 'dp[g1][g2] = ways to split the elements seen so far into seq1 with GCD g1 and seq2 with GCD g2 (0 means empty). Each element goes to seq1, seq2, or neither. Answer Σ dp[g][g] for g ≥ 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'dynamic-programming', 'number-theory', 'leetcode'],
    'related_session' => 'find-the-number-of-subsequences-with-equal-gcd',
];
