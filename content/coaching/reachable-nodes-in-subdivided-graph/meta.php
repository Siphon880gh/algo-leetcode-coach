<?php
declare(strict_types=1);

return [
    'title' => 'Reachable Nodes In Subdivided Graph: Dijkstra, then edges from both ends',
    'leetcode' => 882,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: run Dijkstra on the original nodes with weight cnt + 1, count those within maxMoves, and add min(cnt, leftover at u + leftover at v) per edge. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'related_guide' => 'reachable-nodes-in-subdivided-graph',
    'tags' => ['graphs', 'shortest-path', 'heap', 'step-by-step'],
];
