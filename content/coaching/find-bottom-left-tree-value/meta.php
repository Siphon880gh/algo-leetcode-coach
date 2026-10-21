<?php
declare(strict_types=1);

return [
    'title' => 'Find Bottom Left Tree Value: BFS, keep the first node of each level',
    'leetcode' => 513,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: leftmost value in the last row. BFS level by level and record each level\'s first node; or BFS right child first and return the last node popped. [1,2,3,4,null,5,6,null,null,7] → 7. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['trees', 'bfs', 'dfs', 'step-by-step'],
    'related_guide' => 'find-bottom-left-tree-value',
];
