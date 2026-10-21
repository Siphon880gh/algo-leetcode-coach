<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways to Split a String: count the ones',
    'leetcode' => 1573,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: total ones t; if t % 3 ≠ 0 → 0; if t = 0 → C(n − 1, 2); otherwise multiply the zero-gap choices after the t/3-th and 2t/3-th ones. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'number-of-ways-to-split-a-string',
    'tags' => ['math', 'strings', 'step-by-step'],
];
