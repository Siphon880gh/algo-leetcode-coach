<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Repair Edges to Traverse a Graph: binary search on the budget',
    'leetcode' => 3807,
    'difficulty' => 'Med',
    'summary' => 'A larger budget only adds edges, so feasibility is monotone. Binary search over the distinct costs; for each budget, BFS from 0 and check that n − 1 is within k edges.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['breadth-first-search', 'graph', 'binary-search', 'leetcode'],
    'related_session' => 'minimum-cost-to-repair-edges-to-traverse-a-graph',
];
