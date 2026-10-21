<?php
declare(strict_types=1);

return [
    'title' => 'Coin Change II: count combinations, coins in the outer loop',
    'leetcode' => 518,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: count coin combinations (unlimited coins) that make amount. f[0] = 1; for each coin, for j from coin up: f[j] += f[j − coin]. Coins outer counts combinations; amount outer counts permutations (377). 5, [1,2,5] → 4. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dynamic-programming', 'knapsack', 'step-by-step'],
    'related_guide' => 'coin-change-ii',
];
