<?php
declare(strict_types=1);

return [
    'title' => 'Count Unhappy Friends',
    'leetcode' => 1583,
    'difficulty' => 'Med',
    'summary' => 'Precompute rank[x][y] (how much x likes y). x paired with y is unhappy if some u (paired with v) satisfies rank[x][u] < rank[x][y] and rank[u][x] < rank[u][v].',
    'category' => 'LeetCode',
    'subcategory' => 'Simulation',
    'topic' => 'LeetCode · Simulation',
    'tags' => ['sim', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-unhappy-friends',
    'related_session' => 'count-unhappy-friends',
];
