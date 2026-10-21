<?php
declare(strict_types=1);

return [
    'title' => 'Closest Dessert Cost: enumerate toppings 0, 1 or 2',
    'leetcode' => 1774,
    'difficulty' => 'Med',
    'summary' => 'For each base, DFS over toppings choosing 0, 1 or 2 of each (3^m ≤ 59049 combos), tracking the cost closest to target and the lower one on ties. Stop a branch once the cost reaches target.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'kind' => 'algo',
    'tags' => ['backtracking', 'dynamic-programming', 'array', 'leetcode'],
    'related_session' => 'closest-dessert-cost',
];
