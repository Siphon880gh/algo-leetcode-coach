<?php
declare(strict_types=1);

return [
    'title' => 'Remove Covered Intervals: sort and track the max end',
    'leetcode' => 1288,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: sort by start ascending and end descending, then count an interval only when its end exceeds the largest end seen so far. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'related_guide' => 'remove-covered-intervals',
    'tags' => ['sorting', 'intervals', 'step-by-step'],
];
