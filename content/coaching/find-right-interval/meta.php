<?php
declare(strict_types=1);

return [
    'title' => 'Find Right Interval: binary search the smallest start at or after end',
    'leetcode' => 436,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: for each interval, find the index of the interval with the smallest start that is at least its end (it may be itself), else −1. Sort (start, index) and binary search each end. [[3,4],[2,3],[1,2]] → [−1,0,1]. Not 56 / 435. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'sorting', 'intervals', 'step-by-step'],
    'related_guide' => 'find-right-interval',
];
