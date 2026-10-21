<?php
declare(strict_types=1);

return [
    'title' => 'Minesweeper: reveal with DFS, stop at numbered cells',
    'leetcode' => 529,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: apply one Minesweeper click. M → X. E with adjacent mines → the digit. E with none → B, then reveal adjacent E cells recursively. 8 directions. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Depth-First Search',
    'topic' => 'LeetCode · Depth-First Search',
    'tags' => ['dfs', 'bfs', 'matrix', 'simulation', 'step-by-step'],
    'related_guide' => 'minesweeper',
];
