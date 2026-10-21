<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways to Separate Numbers: DP with LCP comparisons',
    'leetcode' => 1977,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][l] = ways to split the prefix ending at i + l with last number num[i : i + l]. A shorter previous number is always smaller; an equal-length one needs a comparison, done in O(1) with a precomputed longest-common-prefix table. Prefix sums over lengths make it O(n²).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'string', 'suffix-array', 'leetcode'],
    'related_session' => 'number-of-ways-to-separate-numbers',
];
