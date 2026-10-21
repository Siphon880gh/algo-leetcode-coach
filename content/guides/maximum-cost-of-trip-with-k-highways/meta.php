<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Cost of Trip With K Highways: bitmask DP over visited cities',
    'leetcode' => 2247,
    'difficulty' => 'Hard',
    'summary' => 'dp[mask][v] = best toll of a trip that visited exactly the cities in mask and ends at v. Extend along each highway to an unvisited city; after k steps, take the maximum. k ≥ n makes it impossible.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'bit-manipulation', 'graph', 'bitmask', 'leetcode'],
    'related_session' => 'maximum-cost-of-trip-with-k-highways',
];
