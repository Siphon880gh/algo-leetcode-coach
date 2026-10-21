<?php
declare(strict_types=1);

return [
    'title' => 'Possible Bipartition: two-color the dislike graph',
    'leetcode' => 886,
    'difficulty' => 'Med',
    'summary' => 'Each dislike is an edge that must cross between the two groups, so the split exists exactly when the graph is bipartite. BFS or DFS from every uncolored person, giving neighbors the opposite color.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graphs', 'bfs', 'union-find', 'leetcode'],
    'related_session' => 'possible-bipartition',
];
