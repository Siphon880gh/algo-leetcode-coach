<?php
declare(strict_types=1);

return [
    'title' => 'Filter Occupied Intervals',
    'leetcode' => 3975,
    'difficulty' => 'Med',
    'summary' => 'Sort by start and merge intervals that overlap or touch (next start at most current end + 1). Then cut [freeStart, freeEnd] out of each merged interval, keeping the left piece and or or right piece that survive.',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'tags' => ['sorting', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'filter-occupied-intervals',
    'related_session' => 'filter-occupied-intervals',
];
