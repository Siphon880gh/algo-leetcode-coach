<?php
declare(strict_types=1);

return [
    'title' => 'K-th Smallest Prime Fraction: binary search the value',
    'leetcode' => 786,
    'difficulty' => 'Med',
    'summary' => 'For a guess x between 0 and 1, count fractions arr[i] / arr[j] ≤ x with a two-pointer sweep and remember the largest such fraction. Binary search x until the count is exactly k; that largest fraction is the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['binary-search', 'two-pointers', 'heap', 'sorting', 'leetcode'],
    'related_session' => 'k-th-smallest-prime-fraction',
];
