<?php
declare(strict_types=1);

return [
    'title' => 'Delivering Boxes From Storage to Ports: DP with a monotonic deque',
    'leetcode' => 1687,
    'difficulty' => 'Hard',
    'summary' => 'dp[i] = fewest trips to deliver the first i boxes. A trip carrying boxes j … i − 1 costs 2 + port changes inside it. Keep candidates j in a deque ordered by dp[j] − changes[j], dropping those that break the box or weight limit.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'monotonic-queue', 'prefix-sum', 'leetcode'],
    'related_session' => 'delivering-boxes-from-storage-to-ports',
];
