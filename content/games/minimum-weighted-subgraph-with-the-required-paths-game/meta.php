<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Weighted Subgraph With Required Paths',
    'leetcode' => 2203,
    'difficulty' => 'Hard',
    'summary' => 'The two paths merge at some node v and share v → dest. Run Dijkstra from src1, from src2, and from dest on reversed edges; answer = min over v of d1[v] + d2[v] + d3[v].',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-weighted-subgraph-with-the-required-paths',
    'related_session' => 'minimum-weighted-subgraph-with-the-required-paths',
];
