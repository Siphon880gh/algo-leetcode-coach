<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Merge Stones: interval DP on mergeable lengths',
    'leetcode' => 1000,
    'difficulty' => 'Hard',
    'summary' => 'Each merge turns k piles into 1, so n piles reach one only if (n − 1) % (k − 1) == 0. dp[i][j] is the cheapest way to shrink stones[i..j] as far as possible; split it into a part that becomes one pile and the rest, and add the range sum whenever the range can collapse to one pile.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'prefix-sum', 'leetcode'],
    'related_session' => 'minimum-cost-to-merge-stones',
];
