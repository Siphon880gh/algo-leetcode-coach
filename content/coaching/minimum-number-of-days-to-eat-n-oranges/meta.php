<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Days to Eat N Oranges: memoised divide',
    'leetcode' => 1553,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: f(n) = 1 + min(n % 2 + f(n // 2), n % 3 + f(n // 3)) with memo; f(0) = 0, f(1) = 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'minimum-number-of-days-to-eat-n-oranges',
    'tags' => ['dp', 'memoization', 'step-by-step'],
];
