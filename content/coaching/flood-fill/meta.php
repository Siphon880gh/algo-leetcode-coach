<?php
declare(strict_types=1);

return [
    'title' => 'Flood Fill: guard the same color',
    'leetcode' => 733,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: remember the original color, return early if it equals the new color, and recolor as you DFS. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'related_guide' => 'flood-fill',
    'tags' => ['graphs', 'dfs', 'bfs', 'matrix', 'step-by-step'],
];
