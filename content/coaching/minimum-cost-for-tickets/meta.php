<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost For Tickets: a pass ending today',
    'leetcode' => 983,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: dp[d] covers every travel day up to d; non-travel days copy dp[d − 1], travel days take the cheapest pass that ends today. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'minimum-cost-for-tickets',
    'tags' => ['dynamic-programming', 'arrays', 'step-by-step'],
];
