<?php
declare(strict_types=1);

return [
    'title' => 'Make a Subsequence: LCS as LIS',
    'leetcode' => 1713,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: map arr values to their index in target (drop others) and take the LIS of those indices; answer len(target) − LIS. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'related_guide' => 'minimum-operations-to-make-a-subsequence',
    'tags' => ['binary-search', 'greedy', 'hash-map', 'step-by-step'],
];
