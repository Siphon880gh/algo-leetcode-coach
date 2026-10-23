<?php
declare(strict_types=1);

return [
    'title' => 'Number of Great Partitions: subtract the bad ones',
    'leetcode' => 2518,
    'difficulty' => 'Hard',
    'summary' => 'If total < 2k, nothing works. Otherwise a partition is bad if one group sums to < k. Count subsets with sum < k (knapsack); answer = 2^n − 2 · that count.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-great-partitions',
    'related_session' => 'number-of-great-partitions',
];
