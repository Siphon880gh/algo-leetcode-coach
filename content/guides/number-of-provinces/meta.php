<?php
declare(strict_types=1);

return [
    'title' => 'Number of Provinces: count connected components of an adjacency matrix',
    'leetcode' => 547,
    'difficulty' => 'Med',
    'summary' => 'isConnected[i][j] = 1 means cities i and j are directly connected. A province is a connected component. DFS from each unvisited city and count the starts, or union-find and count roots. [[1,1,0],[1,1,0],[0,0,1]] → 2. [[1,0,0],[0,1,0],[0,0,1]] → 3.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'kind' => 'algo',
    'tags' => ['union-find', 'dfs', 'bfs', 'graphs', 'leetcode'],
    'related_session' => 'number-of-provinces',
];
