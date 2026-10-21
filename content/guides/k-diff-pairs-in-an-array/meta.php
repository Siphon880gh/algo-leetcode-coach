<?php
declare(strict_types=1);

return [
    'title' => 'K-diff Pairs in an Array: count distinct values, special case k = 0',
    'leetcode' => 532,
    'difficulty' => 'Med',
    'summary' => 'Count unique pairs (a, b) with |a − b| = k. Build a counter. If k == 0, count values that appear at least twice. Otherwise count distinct x with x + k also present (each pair counted once from its smaller end). [3,1,4,1,5], 2 → 2. [1,3,1,5,4], 0 → 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['hash-table', 'two-pointers', 'sorting', 'leetcode'],
    'related_session' => 'k-diff-pairs-in-an-array',
];
