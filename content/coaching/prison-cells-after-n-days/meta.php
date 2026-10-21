<?php
declare(strict_types=1);

return [
    'title' => 'Prison Cells After N Days: jump over the cycle',
    'leetcode' => 957,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: after day 1 the end cells stay 0, so states repeat; record when each state was seen and cut n by the cycle length. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'related_guide' => 'prison-cells-after-n-days',
    'tags' => ['hash-table', 'simulation', 'bit-manipulation', 'step-by-step'],
];
