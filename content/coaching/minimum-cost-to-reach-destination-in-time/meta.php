<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Reach Destination in Time: time-layered DP',
    'leetcode' => 1928,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: dp[t][v] = cheapest fees arriving at v at time t; relax edges in time order. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'minimum-cost-to-reach-destination-in-time',
    'tags' => ['dynamic-programming', 'graph', 'shortest-path', 'step-by-step'],
];
