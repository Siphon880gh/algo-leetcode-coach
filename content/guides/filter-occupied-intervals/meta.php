<?php
declare(strict_types=1);

return [
    'title' => 'Filter Occupied Intervals: merge, then cut out the free range',
    'leetcode' => 3975,
    'difficulty' => 'Med',
    'summary' => 'Sort, merge intervals that overlap or touch (start ≤ last end + 1), then keep the parts of each merged interval left of freeStart and right of freeEnd.',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'kind' => 'algo',
    'tags' => ['array', 'sorting', 'leetcode'],
    'related_session' => 'filter-occupied-intervals',
];
