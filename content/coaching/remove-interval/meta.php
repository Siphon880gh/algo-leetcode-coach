<?php
declare(strict_types=1);

return [
    'title' => 'Remove Interval: clip each interval',
    'leetcode' => 1272,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep intervals that do not overlap the removal, and for overlapping ones keep only the left piece [x, a] and the right piece [b, y] when they are non-empty. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Intervals',
    'topic' => 'LeetCode · Intervals',
    'related_guide' => 'remove-interval',
    'tags' => ['intervals', 'arrays', 'step-by-step'],
];
