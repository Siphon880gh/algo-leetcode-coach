<?php
declare(strict_types=1);

return [
    'title' => 'The Maze II: Dijkstra over stopping cells, edge weight = cells rolled',
    'leetcode' => 505,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: shortest rolled distance for the ball to stop at destination, or −1. Stops are nodes; each roll is an edge weighted by its length. Rolls differ in length, so use Dijkstra. Sample → 12. Builds on 490; 499 adds a hole. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graphs', 'dijkstra', 'heap', 'matrix', 'step-by-step'],
    'related_guide' => 'the-maze-ii',
];
