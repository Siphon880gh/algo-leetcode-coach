<?php
declare(strict_types=1);

return [
    'title' => 'The Number of Ways to Make the Sum: coin change plus a limited coin',
    'leetcode' => 3183,
    'difficulty' => 'Med',
    'summary' => 'Run the unbounded coin-change DP over the unlimited coins, then add dp[n − t · v] for every allowed count t of the limited coin.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'the-number-of-ways-to-make-the-sum',
];
