<?php
declare(strict_types=1);

return [
    'title' => 'Graph Storage: List vs Matrix',
    'summary' => 'An undirected graph as an adjacency list stores each edge twice (once per end), using O(V + E) space. As an adjacency matrix it uses a V times V grid where M[u][v] = 1 if the edge exists: O(1) edge checks, O(V²) space.',
    'category' => 'Data Structures',
    'subcategory' => 'Graphs',
    'topic' => 'Data Structures · Graphs',
    'tags' => ['graph', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'graph',
    'related_session' => 'graph',
];
