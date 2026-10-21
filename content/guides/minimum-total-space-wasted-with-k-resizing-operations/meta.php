<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Total Space Wasted With K Resizing Operations: partition DP',
    'leetcode' => 1959,
    'difficulty' => 'Med',
    'summary' => 'k resizes split time into at most k + 1 segments; each segment uses its maximum as the size. Precompute cost(i, j) = max · length − sum, then dp[j][s] = min over i of dp[i][s − 1] + cost(i, j − 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'leetcode'],
    'related_session' => 'minimum-total-space-wasted-with-k-resizing-operations',
];
