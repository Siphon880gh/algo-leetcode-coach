<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Cut a Stick: interval DP on cuts',
    'leetcode' => 1547,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: add 0 and n to the sorted cuts; dp[i][j] = c[j] − c[i] + min over k of dp[i][k] + dp[k][j]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'minimum-cost-to-cut-a-stick',
    'tags' => ['dp', 'interval-dp', 'step-by-step'],
];
