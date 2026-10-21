<?php
declare(strict_types=1);

return [
    'title' => 'Intervals Between Identical Elements: prefix sums per value',
    'leetcode' => 2121,
    'difficulty' => 'Med',
    'summary' => 'Group indices by value. For the k-th index p in a group of m with prefix sum pre before it, the total distance is k · p − pre + (sum after p) − (m − k − 1) · p. Use 64-bit.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['prefix-sum', 'hash-table', 'array', 'leetcode'],
    'related_session' => 'intervals-between-identical-elements',
];
