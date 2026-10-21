<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Compatibility Score Sum: DP over used mentors',
    'leetcode' => 1947,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: precompute scores, dp[mask] over mentors used, student index = popcount(mask). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Bitmask DP',
    'topic' => 'LeetCode · Bitmask DP',
    'related_guide' => 'maximum-compatibility-score-sum',
    'tags' => ['bitmask', 'dynamic-programming', 'backtracking', 'step-by-step'],
];
