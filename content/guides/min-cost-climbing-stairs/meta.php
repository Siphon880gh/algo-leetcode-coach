<?php
declare(strict_types=1);

return [
    'title' => 'Min Cost Climbing Stairs: cheapest way to stand on each step',
    'leetcode' => 746,
    'difficulty' => 'Easy',
    'summary' => 'dp[i] is the cheapest cost to reach step i, coming from i − 1 or i − 2 and paying that step\'s cost. You may start at step 0 or 1, and the top is one past the last step.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'arrays', 'leetcode'],
    'related_session' => 'min-cost-climbing-stairs',
];
