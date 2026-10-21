<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Length of Repeated Subarray: reset on mismatch',
    'leetcode' => 718,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: dp of common runs ending at each pair, extend from the diagonal on a match, reset to 0 otherwise, and take the max. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'maximum-length-of-repeated-subarray',
    'tags' => ['dynamic-programming', 'arrays', 'binary-search', 'rolling-hash', 'step-by-step'],
];
