<?php
declare(strict_types=1);

return [
    'title' => 'Find Valid Matrix Given Row and Column Sums: min greedy',
    'leetcode' => 1605,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: each cell takes min(rowSum[i], colSum[j]) and subtracts it from both; any valid matrix is accepted. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'find-valid-matrix-given-row-and-column-sums',
    'tags' => ['greedy', 'matrix', 'step-by-step'],
];
