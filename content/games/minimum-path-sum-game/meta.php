<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Path Sum: cheapest way in',
    'leetcode' => 64,
    'difficulty' => 'Med',
    'summary' => 'cost[r][c] = grid[r][c] + min(cost above, cost left). The first row and column have only one way in, so they are running sums.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-path-sum',
    'related_session' => 'minimum-path-sum',
];
