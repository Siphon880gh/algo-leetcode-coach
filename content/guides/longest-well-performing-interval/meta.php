<?php
declare(strict_types=1);

return [
    'title' => 'Longest Well-Performing Interval: prefix sums of ±1',
    'leetcode' => 1124,
    'difficulty' => 'Med',
    'summary' => 'Score each day +1 if hours exceed 8, else −1. An interval is well performing when its sum is positive. With prefix sums, a positive prefix covers everything so far; otherwise the best start is the first index where the prefix was one lower.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['hash-table', 'prefix-sum', 'monotonic-stack', 'leetcode'],
    'related_session' => 'longest-well-performing-interval',
];
