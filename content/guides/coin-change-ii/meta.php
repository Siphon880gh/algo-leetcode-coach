<?php
declare(strict_types=1);

return [
    'title' => 'Coin Change II: count combinations, coins in the outer loop',
    'leetcode' => 518,
    'difficulty' => 'Med',
    'summary' => 'Count the combinations of coins (unlimited each) that make amount. f[0] = 1; for each coin, for j from coin up to amount: f[j] += f[j − coin]. Coins outer means each combination is counted once, in coin order. Amount outer counts permutations (377). 5, [1,2,5] → 4. 3, [2] → 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'knapsack', 'leetcode'],
    'related_session' => 'coin-change-ii',
];
