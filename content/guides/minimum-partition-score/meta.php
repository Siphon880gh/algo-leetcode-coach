<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Partition Score: layered DP with a convex hull',
    'leetcode' => 3826,
    'difficulty' => 'Hard',
    'summary' => 'Value s(s + 1) / 2 summed over parts is (Σ s² + total) / 2, so minimize Σ s². With prefix sums P, f_j[i] = min over p of f_(j−1)[p] + (P_i − P_p)². Each p is a line with slope −2P_p; slopes fall and queries P_i rise, so a monotone deque answers each layer in O(n).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['queue', 'array', 'divide-and-conquer', 'dynamic-programming', 'prefix-sum', 'monotonic-queue', 'leetcode'],
    'related_session' => 'minimum-partition-score',
];
