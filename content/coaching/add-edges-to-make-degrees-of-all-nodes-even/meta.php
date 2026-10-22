<?php
declare(strict_types=1);

return [
    'title' => 'Add Edges to Make Degrees of All Nodes Even: a third node helps, try every pairing',
    'leetcode' => 2508,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: when the two odd nodes are adjacent, look for a node joined to neither, and with four odd nodes try all three pairings. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'related_guide' => 'add-edges-to-make-degrees-of-all-nodes-even',
    'tags' => ['hash-table', 'graph', 'step-by-step'],
];
