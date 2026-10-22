<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Cycle in a Graph: skip the parent edge, start everywhere',
    'leetcode' => 2608,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: ignore the edge back to the BFS parent, and run a BFS from every vertex. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'related_guide' => 'shortest-cycle-in-a-graph',
    'tags' => ['breadth-first-search', 'graph', 'step-by-step'],
];
