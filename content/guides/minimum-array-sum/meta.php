<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Array Sum: DP over operations used',
    'leetcode' => 3366,
    'difficulty' => 'Med',
    'summary' => 'dp[a][b] = smallest sum so far using a halvings and b subtractions. Each element takes none, one, or both operations; for both, try both orders, because subtracting first can be the only legal order.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'minimum-array-sum',
];
