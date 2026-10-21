<?php
declare(strict_types=1);

return [
    'title' => 'Convert to Base -2: force the digit to 0 or 1',
    'leetcode' => 1017,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: take r = n & 1, append it, set n = (n − r) / −2, repeat until n is 0, then reverse; return "0" for n = 0. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'convert-to-base-2',
    'tags' => ['math', 'step-by-step'],
];
