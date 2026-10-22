<?php
declare(strict_types=1);

return [
    'title' => 'Number of Beautiful Partitions: DP over cut points with a running sum',
    'leetcode' => 2478,
    'difficulty' => 'Hard',
    'summary' => 'Cuts can only go between a non-prime digit and a prime digit. dp over the number of parts and the end position, with a running prefix sum over valid starts at least minLength back, counts partitions in O(k · n).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['string', 'dynamic-programming', 'prefix-sum', 'leetcode'],
    'related_session' => 'number-of-beautiful-partitions',
];
