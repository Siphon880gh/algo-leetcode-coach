<?php
declare(strict_types=1);

return [
    'title' => 'Reconstruct a 2-Row Binary Matrix: forced columns first',
    'leetcode' => 1253,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: check upper + lower against the total, fill 2-columns in both rows, give 1-columns to the upper row while it has room, and verify both counts end at 0. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'reconstruct-a-2-row-binary-matrix',
    'tags' => ['greedy', 'matrix', 'step-by-step'],
];
