<?php
declare(strict_types=1);

return [
    'title' => 'Closest Leaf in a Binary Tree: add parent edges, then BFS',
    'leetcode' => 742,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: record parents, BFS from the k node over children and parent, and stop at the first leaf. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'closest-leaf-in-a-binary-tree',
    'tags' => ['trees', 'bfs', 'graphs', 'dfs', 'step-by-step'],
];
