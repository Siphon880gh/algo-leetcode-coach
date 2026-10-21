<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Path Cost in a Hidden Grid: explore, then Dijkstra',
    'leetcode' => 1810,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: map reachable cells and their entry costs with a backtracking DFS, recording the target; then Dijkstra on the map. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Shortest Path',
    'topic' => 'LeetCode · Shortest Path',
    'related_guide' => 'minimum-path-cost-in-a-hidden-grid',
    'tags' => ['depth-first-search', 'shortest-path', 'interactive', 'step-by-step'],
];
