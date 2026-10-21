<?php
declare(strict_types=1);

return [
    'title' => 'Set Intersection Size At Least Two: rightmost points',
    'leetcode' => 757,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: sort by end ascending with ties by start descending, track the two largest chosen points, and add what each interval lacks at its right end. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'set-intersection-size-at-least-two',
    'tags' => ['greedy', 'sorting', 'intervals', 'step-by-step'],
];
