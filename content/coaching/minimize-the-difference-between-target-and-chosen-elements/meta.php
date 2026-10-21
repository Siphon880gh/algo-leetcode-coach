<?php
declare(strict_types=1);

return [
    'title' => 'Minimize the Difference Between Target and Chosen Elements: pruned sums',
    'leetcode' => 1981,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: track reachable sums row by row, keeping sums ≤ target and only the smallest above it. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'minimize-the-difference-between-target-and-chosen-elements',
    'tags' => ['dynamic-programming', 'matrix', 'step-by-step'],
];
