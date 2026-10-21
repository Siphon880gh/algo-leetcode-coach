<?php
declare(strict_types=1);

return [
    'title' => 'Digit Count in Range: per-position counting',
    'leetcode' => 1067,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: count d in 1..n one place value at a time from the digits above, at, and below it; answer count(high) − count(low − 1), and treat d = 0 specially. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'digit-count-in-range',
    'tags' => ['math', 'digit-dp', 'step-by-step'],
];
