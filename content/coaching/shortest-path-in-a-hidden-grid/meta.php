<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Path in a Hidden Grid: explore with DFS, then BFS',
    'leetcode' => 1778,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: map reachable cells with a backtracking DFS in relative coordinates, recording the target; then BFS the map from the start. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'related_guide' => 'shortest-path-in-a-hidden-grid',
    'tags' => ['depth-first-search', 'breadth-first-search', 'interactive', 'step-by-step'],
];
