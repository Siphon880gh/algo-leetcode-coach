<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Sum of Two Non-Overlapping Subarrays: two orders',
    'leetcode' => 1031,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: with prefix sums, sweep the right window and keep the best left window ending before it, then repeat with the lengths swapped. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'maximum-sum-of-two-non-overlapping-subarrays',
    'tags' => ['dynamic-programming', 'prefix-sum', 'sliding-window', 'arrays', 'step-by-step'],
];
