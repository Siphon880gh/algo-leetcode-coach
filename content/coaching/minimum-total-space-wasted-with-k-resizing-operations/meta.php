<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Total Space Wasted With K Resizing Operations: segment DP',
    'leetcode' => 1959,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: precompute each segment\'s waste at its max, then dp over end position and segment count up to k + 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'minimum-total-space-wasted-with-k-resizing-operations',
    'tags' => ['dynamic-programming', 'step-by-step'],
];
