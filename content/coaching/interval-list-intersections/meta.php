<?php
declare(strict_types=1);

return [
    'title' => 'Interval List Intersections: two pointers',
    'leetcode' => 986,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: overlap the current intervals as [max of starts, min of ends], keep it if non-empty, then drop the interval that ends first. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'related_guide' => 'interval-list-intersections',
    'tags' => ['two-pointers', 'intervals', 'arrays', 'step-by-step'],
];
