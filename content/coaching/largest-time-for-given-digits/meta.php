<?php
declare(strict_types=1);

return [
    'title' => 'Largest Time for Given Digits: check all 24 orders',
    'leetcode' => 949,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: try every permutation, keep those with hours < 24 and minutes < 60, and return the largest formatted as HH:MM. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'related_guide' => 'largest-time-for-given-digits',
    'tags' => ['strings', 'enumeration', 'step-by-step'],
];
