<?php
declare(strict_types=1);

return [
    'title' => 'Paths Whose Sum Is Divisible by k: count by remainder',
    'leetcode' => 2435,
    'difficulty' => 'Hard',
    'summary' => 'dp[r][c][m] = paths to (r, c) with sum ≡ m (mod k), from the cell above and the cell to the left, shifted by grid[r][c].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'paths-in-matrix-whose-sum-is-divisible-by-k',
    'related_session' => 'paths-in-matrix-whose-sum-is-divisible-by-k',
];
