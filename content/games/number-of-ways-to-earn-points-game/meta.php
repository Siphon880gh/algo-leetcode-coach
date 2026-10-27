<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways to Earn Points: bounded knapsack per type',
    'leetcode' => 2585,
    'difficulty' => 'Hard',
    'summary' => 'dp[s] = ways to score s with the types so far. For each type (count, marks), take 0 to count questions: new[s] = the sum of dp[s − t times marks].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-ways-to-earn-points',
    'related_session' => 'number-of-ways-to-earn-points',
];
