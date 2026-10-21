<?php
declare(strict_types=1);

return [
    'title' => 'Number of Increasing Paths in a Grid: larger neighbours finished first',
    'leetcode' => 2328,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: process cells from largest value down, start each count at 1, and follow only strictly larger neighbours. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'number-of-increasing-paths-in-a-grid',
    'tags' => ['array', 'dynamic-programming', 'depth-first-search', 'breadth-first-search', 'graph', 'topological-sort', 'memoization', 'matrix', 'step-by-step'],
];
