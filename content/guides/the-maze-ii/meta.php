<?php
declare(strict_types=1);

return [
    'title' => 'The Maze II: Dijkstra over stopping cells, edge weight = cells rolled',
    'leetcode' => 505,
    'difficulty' => 'Med',
    'summary' => 'Shortest distance (cells rolled) for the ball to stop at destination, or −1. Stops are nodes; a roll in each direction is an edge whose weight is its length. Rolls have different lengths, so use Dijkstra (or SPFA-style BFS that re-queues on improvement). Sample → 12. Builds on 490; 499 adds a hole and paths.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graphs', 'dijkstra', 'heap', 'bfs', 'matrix', 'leetcode'],
    'related_session' => 'the-maze-ii',
];
