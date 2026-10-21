<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Time to Complete Trips: search on time',
    'leetcode' => 2187,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: binary search the time, start the upper bound at min(time) · totalTrips, and stop summing once enough trips are counted. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'related_guide' => 'minimum-time-to-complete-trips',
    'tags' => ['array', 'binary-search', 'step-by-step'],
];
