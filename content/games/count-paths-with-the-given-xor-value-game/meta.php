<?php
declare(strict_types=1);

return [
    'title' => 'Count Paths With the Given XOR: 16 states per cell',
    'leetcode' => 3393,
    'difficulty' => 'Med',
    'summary' => 'dp[r][c][x] = paths to (r, c) whose XOR is x (values < 16). Combine from above and from the left, XORing in grid[r][c].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-paths-with-the-given-xor-value',
    'related_session' => 'count-paths-with-the-given-xor-value',
];
