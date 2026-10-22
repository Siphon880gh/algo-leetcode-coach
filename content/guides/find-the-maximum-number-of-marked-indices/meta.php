<?php
declare(strict_types=1);

return [
    'title' => 'Find the Maximum Number of Marked Indices: small half against large half',
    'leetcode' => 2576,
    'difficulty' => 'Med',
    'summary' => 'At most n / 2 pairs exist, and the best pairs match the smallest half against the largest half. Sort, then walk two pointers: i over the small half, j over the large half, pairing when 2 · a[i] ≤ a[j].',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'kind' => 'algo',
    'tags' => ['array', 'two-pointers', 'binary-search', 'greedy', 'sorting', 'leetcode'],
    'related_session' => 'find-the-maximum-number-of-marked-indices',
];
