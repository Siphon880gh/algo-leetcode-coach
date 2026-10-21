<?php
declare(strict_types=1);

return [
    'title' => 'Build Array Where You Can Find The Maximum Exactly K Comparisons: DP on (length, max, cost)',
    'leetcode' => 1420,
    'difficulty' => 'Hard',
    'summary' => 'The search cost counts how many times a new maximum appears. dp over (position, current max, cost): a value ≤ max keeps the cost (max ways), and a value above max sets a new max and adds 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'prefix-sum', 'leetcode'],
    'related_session' => 'build-array-where-you-can-find-the-maximum-exactly-k-comparisons',
];
