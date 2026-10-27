<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Make Elements Within K Subarrays Equal',
    'leetcode' => 3505,
    'difficulty' => 'Hard',
    'summary' => 'A window of size x is cheapest to flatten to its median: cost = Σ|a − median|. Then dp[i][j] = min(dp[i−1][j], dp[i−x][j−1] + cost of the window ending at i−1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-operations-to-make-elements-within-k-subarrays-equal',
    'related_session' => 'minimum-operations-to-make-elements-within-k-subarrays-equal',
];
