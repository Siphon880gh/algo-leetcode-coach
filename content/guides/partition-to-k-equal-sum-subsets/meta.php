<?php
declare(strict_types=1);

return [
    'title' => 'Partition to K Equal Sum Subsets: fill buckets with pruning',
    'leetcode' => 698,
    'difficulty' => 'Med',
    'summary' => 'Each subset must sum to total / k. Sort descending and place numbers into k buckets with backtracking, skipping buckets with the same current sum. Or use a bitmask DP over the used numbers.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'kind' => 'algo',
    'tags' => ['backtracking', 'bitmask', 'dynamic-programming', 'leetcode'],
    'related_session' => 'partition-to-k-equal-sum-subsets',
];
