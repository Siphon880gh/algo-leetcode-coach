<?php
declare(strict_types=1);

return [
    'title' => 'Number of Restricted Paths From First to Last Node: Dijkstra then DP',
    'leetcode' => 1786,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: Dijkstra from node n; then in increasing distance order, ways[u] sums ways of neighbours with strictly smaller distance. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Shortest Path',
    'topic' => 'LeetCode · Shortest Path',
    'related_guide' => 'number-of-restricted-paths-from-first-to-last-node',
    'tags' => ['shortest-path', 'dynamic-programming', 'graph', 'step-by-step'],
];
