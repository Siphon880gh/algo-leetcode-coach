<?php
declare(strict_types=1);

return [
    'title' => 'Max Length of Subarray With Positive Product: sign lengths',
    'leetcode' => 1567,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep pos and neg lengths for subarrays ending here; positive extends both, negative swaps, zero resets. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'maximum-length-of-subarray-with-positive-product',
    'tags' => ['dp', 'greedy', 'step-by-step'],
];
