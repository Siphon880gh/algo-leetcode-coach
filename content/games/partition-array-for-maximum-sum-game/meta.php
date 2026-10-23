<?php
declare(strict_types=1);

return [
    'title' => 'Partition Array for Maximum Sum: try every last-block length',
    'leetcode' => 1043,
    'difficulty' => 'Med',
    'summary' => 'dp[i] = best sum for the first i numbers = max over len ≤ k of dp[i − len] + len · max(last len numbers).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'partition-array-for-maximum-sum',
    'related_session' => 'partition-array-for-maximum-sum',
];
