<?php
declare(strict_types=1);

return [
    'title' => 'Number of Closed Islands: clear the border first',
    'leetcode' => 1254,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: remember that 0 is land, flood-fill land touching the border, then count the remaining land components. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'related_guide' => 'number-of-closed-islands',
    'tags' => ['graphs', 'dfs', 'bfs', 'matrix', 'step-by-step'],
];
