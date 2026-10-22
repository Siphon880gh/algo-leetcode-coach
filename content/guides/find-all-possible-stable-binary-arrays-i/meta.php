<?php
declare(strict_types=1);

return [
    'title' => 'Find All Possible Stable Binary Arrays I: DP on the last run',
    'leetcode' => 3129,
    'difficulty' => 'Med',
    'summary' => 'A stable array has no run longer than limit. dp[i][j][e] counts arrays with i zeros and j ones ending in e; the last run has length 1 … limit.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'prefix-sum', 'leetcode'],
    'related_session' => 'find-all-possible-stable-binary-arrays-i',
];
