<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways to Form a Target: letter counts per column',
    'leetcode' => 1639,
    'difficulty' => 'Hard',
    'summary' => 'cnt[k][c] = words with letter c at column k. dp[i][k] = ways to form target[0 to i) using columns before k = dp[i][k−1] + dp[i−1][k−1] times cnt[k−1][target[i−1]].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-ways-to-form-a-target-string-given-a-dictionary',
    'related_session' => 'number-of-ways-to-form-a-target-string-given-a-dictionary',
];
