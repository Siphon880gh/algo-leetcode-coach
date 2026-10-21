<?php
declare(strict_types=1);

return [
    'title' => 'Detect Cycles in 2D Grid: union-find on same-letter edges',
    'leetcode' => 1559,
    'difficulty' => 'Med',
    'summary' => 'Union each cell with its right and down neighbours of the same letter. If an edge joins two cells already in one component, a cycle exists (any grid cycle has length ≥ 4).',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'kind' => 'algo',
    'tags' => ['union-find', 'dfs', 'matrix', 'leetcode'],
    'related_session' => 'detect-cycles-in-2d-grid',
];
