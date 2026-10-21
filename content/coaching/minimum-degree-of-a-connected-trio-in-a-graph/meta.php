<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Degree of a Connected Trio in a Graph: edge plus common neighbour',
    'leetcode' => 1761,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: for each edge (u, v) and common neighbour w, compute deg(u) + deg(v) + deg(w) − 6 and keep the minimum. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'related_guide' => 'minimum-degree-of-a-connected-trio-in-a-graph',
    'tags' => ['graph', 'enumeration', 'step-by-step'],
];
