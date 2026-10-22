<?php
declare(strict_types=1);

return [
    'title' => 'Time Needed to Rearrange a Binary String: zeros or one more than the 1 ahead',
    'leetcode' => 2380,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: take max(previous + 1, zeros) for each 1, skip 1s with no zeros before them, and count seconds rather than swaps. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'time-needed-to-rearrange-a-binary-string',
    'tags' => ['string', 'dynamic-programming', 'simulation', 'step-by-step'],
];
