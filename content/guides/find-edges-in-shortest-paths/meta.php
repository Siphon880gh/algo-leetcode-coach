<?php
declare(strict_types=1);

return [
    'title' => 'Find Edges in Shortest Paths: Dijkstra from both ends',
    'leetcode' => 3123,
    'difficulty' => 'Hard',
    'summary' => 'Run Dijkstra from 0 and from n − 1. Edge (a, b, w) lies on a shortest path when d0[a] + w + dn[b] = D or d0[b] + w + dn[a] = D, where D = d0[n − 1]; if n − 1 is unreachable, every answer is false.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graph', 'heap', 'shortest-path', 'depth-first-search', 'leetcode'],
    'related_session' => 'find-edges-in-shortest-paths',
];
