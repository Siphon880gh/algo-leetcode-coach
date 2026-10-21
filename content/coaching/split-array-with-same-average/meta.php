<?php
declare(strict_types=1);

return [
    'title' => 'Split Array With Same Average: sizes and sums',
    'leetcode' => 805,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: both parts keep the overall average, so look for a subset of size k with sum total · k / n, tracking reachable sums per size. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'split-array-with-same-average',
    'tags' => ['dynamic-programming', 'bitmask', 'math', 'step-by-step'],
];
