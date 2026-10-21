<?php
declare(strict_types=1);

return [
    'title' => 'Closest Dessert Cost: enumerate toppings 0, 1 or 2',
    'leetcode' => 1774,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: per base, DFS over toppings with 0, 1 or 2 of each, tracking the closest cost (lower on ties) and pruning once the cost reaches target. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'related_guide' => 'closest-dessert-cost',
    'tags' => ['backtracking', 'dynamic-programming', 'array', 'step-by-step'],
];
