<?php
declare(strict_types=1);

return [
    'title' => 'Two Best Non-Overlapping Events: sort by start, suffix maximum',
    'leetcode' => 2054,
    'difficulty' => 'Med',
    'summary' => 'Sort events by start time and build suffix maxima of value. For each event, binary search the first event starting after its end and add that suffix maximum (0 if none).',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['binary-search', 'sorting', 'dynamic-programming', 'leetcode'],
    'related_session' => 'two-best-non-overlapping-events',
];
