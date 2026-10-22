<?php
declare(strict_types=1);

return [
    'title' => 'Construct String with Minimum Cost: DP over positions, grouped by word length',
    'leetcode' => 3213,
    'difficulty' => 'Hard',
    'summary' => 'dp[i] = cheapest way to build target[0 … i). The total word length is at most 5 · 10^4, so there are at most 315 distinct lengths; for each length, look up the substring in a hash map of cheapest costs.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'string', 'dynamic-programming', 'suffix-array', 'leetcode'],
    'related_session' => 'construct-string-with-minimum-cost',
];
