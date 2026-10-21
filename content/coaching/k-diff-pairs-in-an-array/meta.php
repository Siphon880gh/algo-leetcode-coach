<?php
declare(strict_types=1);

return [
    'title' => 'K-diff Pairs in an Array: count distinct values, special case k = 0',
    'leetcode' => 532,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: unique value pairs with |a − b| = k. Counter; k == 0 → values with count ≥ 2; k > 0 → distinct x with x + k present. [3,1,4,1,5], 2 → 2. [1,3,1,5,4], 0 → 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'tags' => ['hash-table', 'two-pointers', 'sorting', 'step-by-step'],
    'related_guide' => 'k-diff-pairs-in-an-array',
];
