<?php
declare(strict_types=1);

return [
    'title' => 'Largest Sum of Averages: the last group decides',
    'leetcode' => 813,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: dp over prefix length and group count, try every start of the last group, and use prefix sums for averages. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'largest-sum-of-averages',
    'tags' => ['dynamic-programming', 'prefix-sum', 'arrays', 'step-by-step'],
];
