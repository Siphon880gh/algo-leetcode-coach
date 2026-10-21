<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Weighted Subgraph With the Required Paths: three Dijkstras',
    'leetcode' => 2203,
    'difficulty' => 'Hard',
    'summary' => 'The two paths merge at some node m and share the route from m to dest. Run Dijkstra from src1, from src2, and from dest on reversed edges; the answer is the minimum of d1[m] + d2[m] + d3[m].',
    'category' => 'LeetCode',
    'subcategory' => 'Shortest Path',
    'topic' => 'LeetCode · Shortest Path',
    'kind' => 'algo',
    'tags' => ['graph', 'heap', 'shortest-path', 'leetcode'],
    'related_session' => 'minimum-weighted-subgraph-with-the-required-paths',
];
