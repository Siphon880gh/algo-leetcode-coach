<?php
declare(strict_types=1);

return [
    'title' => 'Is Graph Bipartite?: color every component',
    'leetcode' => 785,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: BFS from every uncolored node, give neighbors the opposite color, and fail on a same-color edge. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'related_guide' => 'is-graph-bipartite',
    'tags' => ['graphs', 'bfs', 'dfs', 'union-find', 'step-by-step'],
];
