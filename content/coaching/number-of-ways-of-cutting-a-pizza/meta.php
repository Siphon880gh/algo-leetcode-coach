<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways of Cutting a Pizza: suffix sums + DP',
    'leetcode' => 1444,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: suffix apple counts; dp(i, j, c) over cuts that give away a top or left strip containing an apple; base case: the remainder has an apple. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'number-of-ways-of-cutting-a-pizza',
    'tags' => ['dp', 'prefix-sum', 'matrix', 'step-by-step'],
];
