<?php
declare(strict_types=1);

return [
    'title' => 'Critical and Pseudo-Critical MST Edges: skip and force',
    'leetcode' => 1489,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: base MST weight; an edge is critical if skipping it raises the weight or disconnects; else pseudo-critical if forcing it keeps the base weight. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'related_guide' => 'find-critical-and-pseudo-critical-edges-in-minimum-spanning-tree',
    'tags' => ['graph', 'mst', 'union-find', 'step-by-step'],
];
