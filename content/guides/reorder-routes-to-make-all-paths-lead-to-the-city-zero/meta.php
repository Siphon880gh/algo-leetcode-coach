<?php
declare(strict_types=1);

return [
    'title' => 'Reorder Routes to Make All Paths Lead to the City Zero: count away-pointing edges',
    'leetcode' => 1466,
    'difficulty' => 'Med',
    'summary' => 'Treat the tree as undirected but remember each edge\'s original direction. Traverse from 0; every edge used in its original direction points away from 0 and must be reversed.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'kind' => 'algo',
    'tags' => ['graph', 'dfs', 'bfs', 'leetcode'],
    'related_session' => 'reorder-routes-to-make-all-paths-lead-to-the-city-zero',
];
