<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Repair Edges to Traverse a Graph',
    'leetcode' => 3807,
    'difficulty' => 'Med',
    'summary' => 'More money only adds edges, so binary search money over the sorted distinct weights. For a candidate, BFS from 0 over edges with cost at most money and check that n − 1 is reached within k edges.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-cost-to-repair-edges-to-traverse-a-graph',
    'related_session' => 'minimum-cost-to-repair-edges-to-traverse-a-graph',
];
