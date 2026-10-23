<?php
declare(strict_types=1);

return [
    'title' => 'Pizza With 3n Slices: n non-adjacent slices on a circle',
    'leetcode' => 1388,
    'difficulty' => 'Hard',
    'summary' => 'You end up with n slices, no two adjacent, around a circle. Solve twice as a line (drop the last slice, or drop the first): dp[i][j] = max(dp[i−1][j], dp[i−2][j−1] + slice).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'pizza-with-3n-slices',
    'related_session' => 'pizza-with-3n-slices',
];
