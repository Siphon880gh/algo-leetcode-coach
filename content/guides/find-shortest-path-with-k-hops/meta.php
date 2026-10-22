<?php
declare(strict_types=1);

return [
    'title' => 'Find Shortest Path with K Hops: Dijkstra over node and hops used',
    'leetcode' => 2714,
    'difficulty' => 'Hard',
    'summary' => 'Make k + 1 copies of the graph, one per number of free edges used. Each edge can be taken at its weight within a layer or for free into the next layer; run Dijkstra on (node, used).',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graph', 'shortest-path', 'heap', 'leetcode'],
    'related_session' => 'find-shortest-path-with-k-hops',
];
