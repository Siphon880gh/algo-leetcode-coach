<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Palindrome Length From Subsequences: LPS on the concatenation',
    'leetcode' => 1771,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: run LPS DP on word1 + word2 and record dp[i][j] only for matching ends with i in word1 and j in word2. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'maximize-palindrome-length-from-subsequences',
    'tags' => ['dynamic-programming', 'string', 'step-by-step'],
];
