<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Path Cost in a Grid: pay the cell and the move',
    'leetcode' => 2304,
    'difficulty' => 'Med',
    'summary' => 'cost[r][c] = grid[r][c] + min over previous-row cells p of cost[r−1][p] + moveCost[grid[r−1][p]][c].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-path-cost-in-a-grid',
    'related_session' => 'minimum-path-cost-in-a-grid',
];
