<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Make a Subsequence: LCS becomes LIS',
    'leetcode' => 1713,
    'difficulty' => 'Hard',
    'summary' => 'Target has distinct values, so map each arr value to its index in target (dropping others). The longest common subsequence is the LIS of those indices; answer len(target) − LIS.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['binary-search', 'greedy', 'hash-map', 'leetcode'],
    'related_session' => 'minimum-operations-to-make-a-subsequence',
];
