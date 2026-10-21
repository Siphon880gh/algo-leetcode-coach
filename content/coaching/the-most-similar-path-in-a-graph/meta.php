<?php
declare(strict_types=1);

return [
    'title' => 'The Most Similar Path in a Graph: layered DP',
    'leetcode' => 1548,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: dp[i][v] = mismatch(v, i) + min over neighbours u of dp[i−1][u]; keep parents and rebuild. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'the-most-similar-path-in-a-graph',
    'tags' => ['dp', 'graph', 'step-by-step'],
];
