<?php
declare(strict_types=1);

return [
    'title' => 'All Ancestors of a Node in a Directed Acyclic Graph: push sources down',
    'leetcode' => 2192,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: reach every descendant from each source, keep one visited set per source, and visit sources in order so lists come out sorted. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'related_guide' => 'all-ancestors-of-a-node-in-a-directed-acyclic-graph',
    'tags' => ['depth-first-search', 'breadth-first-search', 'graph', 'topological-sort', 'step-by-step'],
];
