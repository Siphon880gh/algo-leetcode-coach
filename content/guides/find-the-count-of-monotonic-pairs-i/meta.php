<?php
declare(strict_types=1);

return [
    'title' => 'Find the Count of Monotonic Pairs I: DP on arr1’s value',
    'leetcode' => 3250,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][v] counts pairs with arr1[i] = v. A previous value u works when u ≤ v and nums[i − 1] − u ≥ nums[i] − v, so u ≤ min(v, v − nums[i] + nums[i − 1]); prefix sums make each step O(1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'dynamic-programming', 'combinatorics', 'prefix-sum', 'leetcode'],
    'related_session' => 'find-the-count-of-monotonic-pairs-i',
];
