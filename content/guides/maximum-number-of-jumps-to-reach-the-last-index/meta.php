<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Jumps to Reach the Last Index: DP from reachable indices',
    'leetcode' => 2770,
    'difficulty' => 'Med',
    'summary' => 'dp[j] is the most jumps that reach j. Take the best dp[i] + 1 over earlier reachable i with |nums[j] − nums[i]| ≤ target, and keep unreachable indices at minus infinity.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'maximum-number-of-jumps-to-reach-the-last-index',
];
