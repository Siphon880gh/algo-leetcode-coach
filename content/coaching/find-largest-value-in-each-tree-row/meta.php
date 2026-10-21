<?php
declare(strict_types=1);

return [
    'title' => 'Find Largest Value in Each Tree Row: BFS, max per level',
    'leetcode' => 515,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: the max value of each tree row. BFS by level and take each level\'s max; or DFS with depth. [1,3,2,5,3,null,9] → [1,3,9]. Empty → []. Start each max at the first node, not 0. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['trees', 'bfs', 'dfs', 'step-by-step'],
    'related_guide' => 'find-largest-value-in-each-tree-row',
];
