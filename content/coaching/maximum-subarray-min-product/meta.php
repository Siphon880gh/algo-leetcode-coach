<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Subarray Min-Product: spans from a monotonic stack',
    'leetcode' => 1856,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: for each element as the minimum, find its widest span with a monotonic stack and use prefix sums. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'related_guide' => 'maximum-subarray-min-product',
    'tags' => ['monotonic-stack', 'prefix-sum', 'array', 'step-by-step'],
];
