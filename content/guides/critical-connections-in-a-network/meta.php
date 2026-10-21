<?php
declare(strict_types=1);

return [
    'title' => 'Critical Connections in a Network: Tarjan bridges',
    'leetcode' => 1192,
    'difficulty' => 'Hard',
    'summary' => 'Do one DFS recording discovery times and low-links, the earliest time reachable through a subtree with one back edge. A tree edge (u, v) is a bridge exactly when low[v] > disc[u].',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'kind' => 'algo',
    'tags' => ['graphs', 'dfs', 'tarjan', 'leetcode'],
    'related_session' => 'critical-connections-in-a-network',
];
