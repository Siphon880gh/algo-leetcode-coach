<?php
declare(strict_types=1);

return [
    'title' => 'Path with Maximum Gold: DFS and restore',
    'leetcode' => 1219,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: DFS from every gold cell, zero the cell while on the path, explore four neighbours, restore it on return, and keep the best sum. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'related_guide' => 'path-with-maximum-gold',
    'tags' => ['backtracking', 'dfs', 'matrix', 'step-by-step'],
];
