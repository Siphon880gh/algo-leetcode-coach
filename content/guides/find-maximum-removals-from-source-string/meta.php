<?php
declare(strict_types=1);

return [
    'title' => 'Find Maximum Removals From Source String: DP over pattern progress',
    'leetcode' => 3316,
    'difficulty' => 'Med',
    'summary' => 'dp[j] = the most removable indices used while matching pattern[0 … j − 1] in the scanned prefix. Each character either is skipped (and removed if it is a target) or matches pattern[j − 1].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'two-pointers', 'string', 'dynamic-programming', 'leetcode'],
    'related_session' => 'find-maximum-removals-from-source-string',
];
