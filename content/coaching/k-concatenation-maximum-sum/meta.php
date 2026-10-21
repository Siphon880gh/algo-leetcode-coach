<?php
declare(strict_types=1);

return [
    'title' => 'K-Concatenation Maximum Sum: two copies plus the middle',
    'leetcode' => 1191,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: Kadane with empty allowed on one copy if k = 1, else on two copies, then add (k − 2) · total when the total is positive, and take the mod at the end. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'k-concatenation-maximum-sum',
    'tags' => ['dynamic-programming', 'kadane', 'arrays', 'step-by-step'],
];
