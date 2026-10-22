<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Strength of K Disjoint Subarrays: DP with alternating weights',
    'leetcode' => 3077,
    'difficulty' => 'Hard',
    'summary' => 'Subarray j (from 1) is weighted (k − j + 1) with sign + for odd j and − for even. Run a DP over the array with states (subarrays used, whether the current one is open); each element either extends the open subarray, starts the next, or is skipped.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'prefix-sum', 'leetcode'],
    'related_session' => 'maximum-strength-of-k-disjoint-subarrays',
];
