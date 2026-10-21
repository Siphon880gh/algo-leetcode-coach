<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Erasure Value: unique-window sum',
    'leetcode' => 1695,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: expand right; while the new value is already in the window, remove from the left; track the window sum and its maximum. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'maximum-erasure-value',
    'tags' => ['sliding-window', 'hash-set', 'step-by-step'],
];
