<?php
declare(strict_types=1);

return [
    'title' => 'Find the Count of Monotonic Pairs II: DP on arr1’s value',
    'leetcode' => 3251,
    'difficulty' => 'Hard',
    'summary' => 'Same DP as part I with values up to 1000: new[v] is a prefix sum of the previous row up to min(v, v − nums[i] + nums[i − 1]).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'dynamic-programming', 'combinatorics', 'prefix-sum', 'leetcode'],
    'related_session' => 'find-the-count-of-monotonic-pairs-ii',
];
