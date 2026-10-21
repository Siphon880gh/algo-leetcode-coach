<?php
declare(strict_types=1);

return [
    'title' => 'Can You Eat Your Favorite Candy on Your Favorite Day?: interval overlap',
    'leetcode' => 1744,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: with prefix sums P, day d covers candies d + 1 … (d + 1) · cap; type t covers P[t] + 1 … P[t + 1]; answer whether those overlap. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'related_guide' => 'can-you-eat-your-favorite-candy-on-your-favorite-day',
    'tags' => ['prefix-sum', 'array', 'step-by-step'],
];
