<?php
declare(strict_types=1);

return [
    'title' => 'Maximize the Minimum Powered City: binary search with a greedy sweep',
    'leetcode' => 2528,
    'difficulty' => 'Hard',
    'summary' => 'Binary search the target minimum. To test it, sweep cities left to right with a difference array; when a city falls short, build the missing stations as far right as possible, at min(i + r, n − 1), and fail if more than k are needed.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'greedy', 'queue', 'sliding-window', 'prefix-sum', 'leetcode'],
    'related_session' => 'maximize-the-minimum-powered-city',
];
