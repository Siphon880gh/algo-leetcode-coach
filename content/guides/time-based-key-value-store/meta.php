<?php
declare(strict_types=1);

return [
    'title' => 'Time Based Key-Value Store: binary search per key',
    'leetcode' => 981,
    'difficulty' => 'Med',
    'summary' => 'Store, for each key, the (timestamp, value) pairs in the order they were set; timestamps only increase, so the list is sorted. get finds the last timestamp ≤ t with binary search.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['binary-search', 'design', 'hash-table', 'leetcode'],
    'related_session' => 'time-based-key-value-store',
];
