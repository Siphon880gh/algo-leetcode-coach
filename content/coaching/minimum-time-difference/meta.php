<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Time Difference: minutes, sort, check neighbors and the wrap',
    'leetcode' => 539,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: smallest minute gap among "HH:MM" times. Convert to minutes, sort, check neighbors and the wrap first + 1440 − last. More than 1440 times → 0. ["23:59","00:00"] → 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'tags' => ['sorting', 'strings', 'math', 'step-by-step'],
    'related_guide' => 'minimum-time-difference',
];
