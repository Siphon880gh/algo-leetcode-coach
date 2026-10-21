<?php
declare(strict_types=1);

return [
    'title' => 'Ways to Split Array Into Three Subarrays: binary search the middle',
    'leetcode' => 1712,
    'difficulty' => 'Med',
    'summary' => 'For each end i of the left part, the middle must end where prefix ≥ 2·P[i] and ≤ (P[i] + total) / 2. Binary search both bounds in the prefix array; count the valid range.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['binary-search', 'prefix-sum', 'two-pointers', 'leetcode'],
    'related_session' => 'ways-to-split-array-into-three-subarrays',
];
