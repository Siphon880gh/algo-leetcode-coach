<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Subarrays in a Valid Split: DP over the last piece’s start',
    'leetcode' => 2464,
    'difficulty' => 'Med',
    'summary' => 'dp[i] is the fewest pieces for the first i numbers. The last piece runs from some j to i and is valid when gcd(nums[j], nums[i]) > 1, so try every j.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'dynamic-programming', 'number-theory', 'leetcode'],
    'related_session' => 'minimum-subarrays-in-a-valid-split',
];
