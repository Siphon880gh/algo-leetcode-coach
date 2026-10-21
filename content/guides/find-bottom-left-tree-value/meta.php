<?php
declare(strict_types=1);

return [
    'title' => 'Find Bottom Left Tree Value: BFS, keep the first node of each level',
    'leetcode' => 513,
    'difficulty' => 'Med',
    'summary' => 'Return the leftmost value in the last row. BFS level by level and record the first node popped in each level; the last record wins. Or BFS right child first and return the last node popped. [2,1,3] → 1. [1,2,3,4,null,5,6,null,null,7] → 7.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'bfs', 'dfs', 'leetcode'],
    'related_session' => 'find-bottom-left-tree-value',
];
