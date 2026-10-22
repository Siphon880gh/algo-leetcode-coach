<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Length of Semi-Decreasing Subarrays: larger values first, smallest index',
    'leetcode' => 2863,
    'difficulty' => 'Med',
    'summary' => 'Visit indices from the largest value down. For index t, the best start is the smallest index already seen with a strictly larger value; equal values are added only after their group is done.',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'kind' => 'algo',
    'tags' => ['array', 'stack', 'sorting', 'monotonic-stack', 'leetcode'],
    'related_session' => 'maximum-length-of-semi-decreasing-subarrays',
];
