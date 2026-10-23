<?php
declare(strict_types=1);

return [
    'title' => 'Reachable Nodes in Subdivided Graph',
    'leetcode' => 882,
    'difficulty' => 'Hard',
    'summary' => 'Dijkstra on the original graph with edge weight cnt + 1. Count original nodes with dist ≤ maxMoves; on each edge, reach min(cnt, leftover from u + leftover from v) new nodes.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'reachable-nodes-in-subdivided-graph',
    'related_session' => 'reachable-nodes-in-subdivided-graph',
];
