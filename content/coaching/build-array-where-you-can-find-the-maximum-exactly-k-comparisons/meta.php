<?php
declare(strict_types=1);

return [
    'title' => 'Build Array Where You Can Find the Maximum Exactly K Comparisons: dp over position, max, cost',
    'leetcode' => 1420,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: dp[i][mx][c] counts prefixes. The next value either stays ≤ mx (mx ways, same cost) or becomes a new max v > mx (cost + 1). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'build-array-where-you-can-find-the-maximum-exactly-k-comparisons',
    'tags' => ['dynamic-programming', 'prefix-sum', 'step-by-step'],
];
