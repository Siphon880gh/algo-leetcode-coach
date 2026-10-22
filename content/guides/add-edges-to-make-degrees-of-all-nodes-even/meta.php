<?php
declare(strict_types=1);

return [
    'title' => 'Add Edges to Make Degrees of All Nodes Even: zero, two or four odd nodes',
    'leetcode' => 2508,
    'difficulty' => 'Hard',
    'summary' => 'Each new edge fixes at most two odd nodes, so more than four odd nodes is hopeless. Two odd nodes: join them, or route both through a third node joined to neither. Four: try the three pairings, each pair not yet adjacent.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['hash-table', 'graph', 'leetcode'],
    'related_session' => 'add-edges-to-make-degrees-of-all-nodes-even',
];
