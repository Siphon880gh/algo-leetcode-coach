<?php
declare(strict_types=1);

return [
    'title' => 'K Non-Overlapping Segments: closed form or DP',
    'leetcode' => 1621,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: segments may share endpoints; the count is C(n + k − 1, 2k) mod 1e9+7, or an O(n · k) DP with prefix sums. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'number-of-sets-of-k-non-overlapping-line-segments',
    'tags' => ['combinatorics', 'dynamic-programming', 'math', 'step-by-step'],
];
