<?php
declare(strict_types=1);

return [
    'title' => 'Out of Boundary Paths: ways per cell, move by move',
    'leetcode' => 576,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: count the ways to stand on each cell after k moves, add the ways that step off the grid, and keep everything modulo 1e9 + 7. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'out-of-boundary-paths',
    'tags' => ['dynamic-programming', 'matrix', 'memoization', 'step-by-step'],
];
