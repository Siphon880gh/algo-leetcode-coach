<?php
declare(strict_types=1);

return [
    'title' => 'Profitable Schemes: knapsack on members, profit capped at the minimum',
    'leetcode' => 879,
    'difficulty' => 'Hard',
    'summary' => 'dp[g][p] = schemes using g members with profit p (capped at minProfit). For each crime, go backwards over g and add dp[g − group][p − profit] into dp[g][min(p, ...)].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'profitable-schemes',
    'related_session' => 'profitable-schemes',
];
