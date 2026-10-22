<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Sum Queries: offline by x, best sum over y',
    'leetcode' => 2736,
    'difficulty' => 'Hard',
    'summary' => 'Sort points and queries by the first bound, largest first. Add points as their nums1 qualifies, and answer each query with the best sum among points whose nums2 is at least y, using a suffix-max tree.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Indexed Tree',
    'topic' => 'LeetCode · Binary Indexed Tree',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'binary-indexed-tree', 'sorting', 'leetcode'],
    'related_session' => 'maximum-sum-queries',
];
