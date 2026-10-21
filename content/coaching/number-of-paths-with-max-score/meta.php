<?php
declare(strict_types=1);

return [
    'title' => 'Number of Paths with Max Score: (best, count) DP',
    'leetcode' => 1301,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: fill from S to E, give each cell the best score among its down, right, and diagonal neighbours plus its digit, and sum the counts of the neighbours tied for that best. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'number-of-paths-with-max-score',
    'tags' => ['dynamic-programming', 'matrix', 'step-by-step'],
];
