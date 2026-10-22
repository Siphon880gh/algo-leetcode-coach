<?php
declare(strict_types=1);

return [
    'title' => 'Median of a Row Wise Sorted Matrix: binary search on the value',
    'leetcode' => 2387,
    'difficulty' => 'Med',
    'summary' => 'Binary search on the answer value. For a candidate x, count elements ≤ x with a binary search in each row; the median is the smallest x whose count reaches (m · n + 1) / 2.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'matrix', 'leetcode'],
    'related_session' => 'median-of-a-row-wise-sorted-matrix',
];
