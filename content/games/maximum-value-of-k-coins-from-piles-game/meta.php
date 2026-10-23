<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Value of k Coins: grouped knapsack over piles',
    'leetcode' => 2218,
    'difficulty' => 'Hard',
    'summary' => 'dp[j] = best value taking j coins from the piles so far. For a pile, taking its top t coins (prefix sum) costs t: dp[j] = max over t of old dp[j − t] + prefix[t].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-value-of-k-coins-from-piles',
    'related_session' => 'maximum-value-of-k-coins-from-piles',
];
