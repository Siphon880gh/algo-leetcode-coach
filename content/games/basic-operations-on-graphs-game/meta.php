<?php
declare(strict_types=1);

return [
    'title' => 'Graph Operations on Adjacency Lists',
    'summary' => 'Store a directed graph as adjacency lists: adj[u] lists every v with an edge u to v. Adding an edge appends to one list. Checking an edge scans adj[u], O(degree). Removing a vertex deletes its own list and scrubs it from every other list.',
    'category' => 'Data Structures',
    'subcategory' => 'Graphs',
    'topic' => 'Data Structures · Graphs',
    'tags' => ['graph', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'basic-operations-on-graphs',
    'related_session' => 'basic-operations-on-graphs',
];
