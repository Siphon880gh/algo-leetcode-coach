<?php
declare(strict_types=1);

return [
    'title' => 'Sum of the Power of All Subsequences: each element in, out, or doubled',
    'leetcode' => 3082,
    'difficulty' => 'Hard',
    'summary' => 'For every subsequence S summing to k, it is counted in 2^(n − |S|) supersets. DP: each element either joins S (dp[s − x]) or not, and when not in S it may or may not be in the superset (×2): dp[s] = 2·dp[s] + dp[s − x].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-the-sum-of-the-power-of-all-subsequences',
    'related_session' => 'find-the-sum-of-the-power-of-all-subsequences',
];
