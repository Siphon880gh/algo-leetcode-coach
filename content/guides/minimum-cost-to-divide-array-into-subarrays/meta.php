<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Divide Array Into Subarrays: move k · i onto suffix costs',
    'leetcode' => 3500,
    'difficulty' => 'Hard',
    'summary' => 'The k · i term adds k times a segment’s cost once for each segment at or before it, which is k times the cost of everything from each segment’s start to the end. So dp[r] = min over l of dp[l − 1] + P[r] · (C[r] − C[l − 1]) + k · (C[n] − C[l − 1]).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'prefix-sum', 'leetcode'],
    'related_session' => 'minimum-cost-to-divide-array-into-subarrays',
];
