<?php
declare(strict_types=1);

return [
    'title' => 'Mountain Array Removals: LIS from both sides',
    'leetcode' => 1671,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: L[i] = LIS ending at i, R[i] = LIS ending at i from the right; for peaks with both > 1, keep L + R − 1; answer n − max. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'minimum-number-of-removals-to-make-mountain-array',
    'tags' => ['dynamic-programming', 'binary-search', 'step-by-step'],
];
