<?php
declare(strict_types=1);

return [
    'title' => 'Valid Permutations for DI Sequence: rank of the last number',
    'leetcode' => 903,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][j] = ways to arrange the first i+1 numbers so the last one is the j-th smallest. After "I": sum dp[i−1][k] for k < j. After "D": sum dp[i−1][k] for k ≥ j.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'valid-permutations-for-di-sequence',
    'related_session' => 'valid-permutations-for-di-sequence',
];
