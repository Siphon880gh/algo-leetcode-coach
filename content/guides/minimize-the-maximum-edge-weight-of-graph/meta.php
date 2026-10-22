<?php
declare(strict_types=1);

return [
    'title' => 'Minimize the Maximum Edge Weight of Graph: reverse edges and binary search',
    'leetcode' => 3419,
    'difficulty' => 'Med',
    'summary' => 'Node 0 must be reachable from everyone, so search from 0 over reversed edges. The threshold never binds: a search tree keeps one outgoing edge per node. Binary search the largest allowed weight.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['depth-first-search', 'breadth-first-search', 'graph', 'binary-search', 'shortest-path', 'leetcode'],
    'related_session' => 'minimize-the-maximum-edge-weight-of-graph',
];
