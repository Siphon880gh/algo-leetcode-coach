<?php
declare(strict_types=1);

return [
    'title' => 'Number of Pairs Satisfying Inequality: rewrite, then count with a sorted structure',
    'leetcode' => 2426,
    'difficulty' => 'Hard',
    'summary' => 'Move the j terms to one side: with d[i] = nums1[i] − nums2[i], the condition is d[i] ≤ d[j] + diff. Scan j left to right and count earlier d values at most d[j] + diff with a Fenwick tree, merge sort or sorted list.',
    'category' => 'LeetCode',
    'subcategory' => 'Divide and Conquer',
    'topic' => 'LeetCode · Divide and Conquer',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'divide-and-conquer', 'binary-indexed-tree', 'segment-tree', 'merge-sort', 'ordered-set', 'leetcode'],
    'related_session' => 'number-of-pairs-satisfying-inequality',
];
