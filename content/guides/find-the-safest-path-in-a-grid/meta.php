<?php
declare(strict_types=1);

return [
    'title' => 'Find the Safest Path in a Grid: distances, then a widest path',
    'leetcode' => 2812,
    'difficulty' => 'Med',
    'summary' => 'A multi-source BFS from every thief gives each cell its distance. Then find the path from corner to corner whose smallest distance is largest, with a max-heap Dijkstra or a binary search plus BFS.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'breadth-first-search', 'union-find', 'heap', 'matrix', 'leetcode'],
    'related_session' => 'find-the-safest-path-in-a-grid',
];
