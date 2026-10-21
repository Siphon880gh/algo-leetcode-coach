<?php
declare(strict_types=1);

return [
    'title' => 'Reorder Routes to City Zero: count forward edges from 0',
    'leetcode' => 1466,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: store each edge both ways with cost 1 for the original direction and 0 for the reverse; traverse from 0 and sum the costs. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'related_guide' => 'reorder-routes-to-make-all-paths-lead-to-the-city-zero',
    'tags' => ['graph', 'dfs', 'bfs', 'step-by-step'],
];
