<?php
declare(strict_types=1);

return [
    'title' => 'Ways to Make a Fair Array: parity swap after removal',
    'leetcode' => 1664,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: removing i flips parity of later indices; with prefix sums, new even = evenBefore + oddAfter, new odd = oddBefore + evenAfter. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'related_guide' => 'ways-to-make-a-fair-array',
    'tags' => ['prefix-sum', 'array', 'step-by-step'],
];
