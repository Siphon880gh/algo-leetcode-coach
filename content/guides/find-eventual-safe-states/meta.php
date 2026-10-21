<?php
declare(strict_types=1);

return [
    'title' => 'Find Eventual Safe States: peel from the terminal nodes',
    'leetcode' => 802,
    'difficulty' => 'Med',
    'summary' => 'A node is safe when every path from it ends at a terminal node. Reverse the edges and run Kahn\'s algorithm from the terminal nodes (out-degree 0): a node becomes safe once all its outgoing edges lead to safe nodes.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graphs', 'topological-sort', 'dfs', 'leetcode'],
    'related_session' => 'find-eventual-safe-states',
];
