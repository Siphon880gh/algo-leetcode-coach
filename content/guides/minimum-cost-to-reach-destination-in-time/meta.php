<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Reach Destination in Time: DP over time',
    'leetcode' => 1928,
    'difficulty' => 'Hard',
    'summary' => 'dp[t][v] = cheapest fee total arriving at v at exactly time t. Relax every edge from each time layer; answer = min over t ≤ maxTime of dp[t][n − 1].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'graph', 'shortest-path', 'leetcode'],
    'related_session' => 'minimum-cost-to-reach-destination-in-time',
];
