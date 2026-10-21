<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways to Paint N × 3 Grid: two pattern classes',
    'leetcode' => 1411,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: split rows into ABA and ABC patterns (6 each), and use the transitions ABA → 3 ABA + 2 ABC and ABC → 2 ABA + 2 ABC, mod 1e9+7. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'number-of-ways-to-paint-n-3-grid',
    'tags' => ['dynamic-programming', 'math', 'step-by-step'],
];
