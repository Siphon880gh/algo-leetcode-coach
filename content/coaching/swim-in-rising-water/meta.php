<?php
declare(strict_types=1);

return [
    'title' => 'Swim in Rising Water: the bottleneck path',
    'leetcode' => 778,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: the cost of a path is its highest cell, so run Dijkstra keyed by the running max (or binary search with BFS). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'related_guide' => 'swim-in-rising-water',
    'tags' => ['graphs', 'dijkstra', 'heap', 'binary-search', 'union-find', 'matrix', 'step-by-step'],
];
