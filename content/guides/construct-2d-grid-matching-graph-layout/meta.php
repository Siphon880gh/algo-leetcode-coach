<?php
declare(strict_types=1);

return [
    'title' => 'Construct 2D Grid Matching Graph Layout: build the first row, then grow downward',
    'leetcode' => 3311,
    'difficulty' => 'Hard',
    'summary' => 'Degrees reveal the shape: a degree-1 node starts a single line; otherwise a degree-2 corner starts the first row, which runs along border nodes of degree below 4 to the next corner. Each later row is the unvisited neighbour of each cell above.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graph', 'array', 'hash-table', 'matrix', 'leetcode'],
    'related_session' => 'construct-2d-grid-matching-graph-layout',
];
