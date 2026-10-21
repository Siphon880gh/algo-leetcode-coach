<?php
declare(strict_types=1);

return [
    'title' => 'Path With Minimum Effort: Dijkstra on max edge',
    'leetcode' => 1631,
    'difficulty' => 'Med',
    'summary' => 'Path cost is the largest height difference along it. Dijkstra with cost = max(current, |Δh|) finds the minimum; binary search plus BFS or Kruskal-style DSU also work.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'kind' => 'algo',
    'tags' => ['dijkstra', 'heap', 'binary-search', 'union-find', 'leetcode'],
    'related_session' => 'path-with-minimum-effort',
];
