<?php
declare(strict_types=1);

return [
    'title' => 'K Inverse Pairs Array: where the largest number goes',
    'leetcode' => 629,
    'difficulty' => 'Hard',
    'summary' => 'Placing n in an array of n−1 numbers creates 0 to n−1 new inverse pairs (by how far from the end it sits). dp[n][k] = the sum of dp[n−1][k−j] for j = 0 to min(k, n−1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'k-inverse-pairs-array',
    'related_session' => 'k-inverse-pairs-array',
];
