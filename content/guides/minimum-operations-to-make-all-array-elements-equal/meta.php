<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Make All Array Elements Equal: sort and prefix sums',
    'leetcode' => 2602,
    'difficulty' => 'Med',
    'summary' => 'For a target q, values below q rise and values above it fall. Sort once and keep prefix sums; binary search where q fits, and the two sides cost q · k − (sum below) and (sum above) − q · (n − k).',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'sorting', 'prefix-sum', 'leetcode'],
    'related_session' => 'minimum-operations-to-make-all-array-elements-equal',
];
