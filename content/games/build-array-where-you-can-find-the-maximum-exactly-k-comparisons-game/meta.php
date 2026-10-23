<?php
declare(strict_types=1);

return [
    'title' => 'Build Array with Exactly k Max Updates: length, max, cost',
    'leetcode' => 1420,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][j][c] = arrays of length i with maximum j and c updates. Appending a value ≤ j keeps both: dp·j. Appending a new maximum j from a smaller max j\' adds one update: Σ dp[i−1][j\'][c−1].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'build-array-where-you-can-find-the-maximum-exactly-k-comparisons',
    'related_session' => 'build-array-where-you-can-find-the-maximum-exactly-k-comparisons',
];
