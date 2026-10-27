<?php
declare(strict_types=1);

return [
    'title' => 'Partition to K Equal Sum Subsets',
    'leetcode' => 698,
    'difficulty' => 'Med',
    'summary' => 'total % k must be 0. Sort descending and fill buckets of size total divided by k by backtracking (skip buckets with equal current sums; fail fast if the largest element is too big).',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'tags' => ['backtracking', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'partition-to-k-equal-sum-subsets',
    'related_session' => 'partition-to-k-equal-sum-subsets',
];
