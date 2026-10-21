<?php
declare(strict_types=1);

return [
    'title' => 'Is Graph Bipartite?: two-color every component',
    'leetcode' => 785,
    'difficulty' => 'Med',
    'summary' => 'Try to color the graph with two colors so every edge joins different colors. BFS or DFS from each uncolored node; an edge between same-colored nodes means it is not bipartite.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graphs', 'bfs', 'dfs', 'union-find', 'leetcode'],
    'related_session' => 'is-graph-bipartite',
];
