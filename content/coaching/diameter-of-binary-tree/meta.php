<?php
declare(strict_types=1);

return [
    'title' => 'Diameter of Binary Tree: best left height + right height at any node',
    'leetcode' => 543,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: longest path in edges between any two nodes. At each node, the best path bending there is left height + right height. DFS returns heights and updates a global best. [1,2,3,4,5] → 3. [1,2] → 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['trees', 'dfs', 'step-by-step'],
    'related_guide' => 'diameter-of-binary-tree',
];
