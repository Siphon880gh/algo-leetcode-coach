<?php
declare(strict_types=1);

return [
    'title' => 'Reachable Nodes In Subdivided Graph: Dijkstra, then count each edge from both ends',
    'leetcode' => 882,
    'difficulty' => 'Hard',
    'summary' => 'Run Dijkstra on the original nodes with edge weight cnt + 1. Count the original nodes within maxMoves, then add min(cnt, leftover from u + leftover from v) for each edge.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graphs', 'shortest-path', 'heap', 'leetcode'],
    'related_session' => 'reachable-nodes-in-subdivided-graph',
];
