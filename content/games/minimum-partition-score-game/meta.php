<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Partition Score',
    'leetcode' => 3826,
    'difficulty' => 'Hard',
    'summary' => 'dp[j][i] = min over p < i of dp[j−1][p] + v(P[i] − P[p]) with v(x) = x(x+1)/2. The cost is convex in the split, so divide-and-conquer optimization (or a convex hull trick) speeds up each layer.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-partition-score',
    'related_session' => 'minimum-partition-score',
];
