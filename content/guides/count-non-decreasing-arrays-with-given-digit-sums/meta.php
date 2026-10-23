<?php
declare(strict_types=1);

return [
    'title' => 'Count Non Decreasing Arrays With Given Digit Sums: prefix-sum DP over values',
    'leetcode' => 3883,
    'difficulty' => 'Hard',
    'summary' => 'Values are at most 5000, so count arrays ending in each value v. A new position with digit sum d takes every v with that digit sum, and the count for v is the prefix sum of the previous counts up to v.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'prefix-sum', 'leetcode'],
    'related_session' => 'count-non-decreasing-arrays-with-given-digit-sums',
];
