<?php
declare(strict_types=1);

return [
    'title' => 'Restore The Array: DP over split points',
    'leetcode' => 1416,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: dp[i] = ways to split s[i:]. From i (s[i] ≠ 0), extend the number while it stays ≤ k, adding dp[j+1]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'restore-the-array',
    'tags' => ['dynamic-programming', 'strings', 'step-by-step'],
];
