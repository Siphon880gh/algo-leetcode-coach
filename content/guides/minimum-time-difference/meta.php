<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Time Difference: minutes, sort, check neighbors and the wrap',
    'leetcode' => 539,
    'difficulty' => 'Med',
    'summary' => 'Smallest difference in minutes between any two "HH:MM" times. Convert each to minutes, sort, take the minimum gap between neighbors, and also the wrap gap first + 1440 − last. More than 1440 times guarantees a duplicate → 0. ["23:59","00:00"] → 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'kind' => 'algo',
    'tags' => ['sorting', 'strings', 'math', 'leetcode'],
    'related_session' => 'minimum-time-difference',
];
