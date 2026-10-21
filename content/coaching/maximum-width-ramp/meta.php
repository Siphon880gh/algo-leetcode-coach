<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Width Ramp: prefix-minimum starts',
    'leetcode' => 962,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: only indices with a new smallest value can be the best start; stack them, then scan j from the right and pop every start with nums[start] ≤ nums[j]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'related_guide' => 'maximum-width-ramp',
    'tags' => ['monotonic-stack', 'arrays', 'two-pointers', 'step-by-step'],
];
