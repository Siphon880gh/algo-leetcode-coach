<?php
declare(strict_types=1);

return [
    'title' => 'Find Largest Value in Each Tree Row: BFS, max per level',
    'leetcode' => 515,
    'difficulty' => 'Med',
    'summary' => 'Return the maximum value in each tree row, top to bottom. BFS level by level and take the max of each level; or DFS with depth and update ans[depth]. [1,3,2,5,3,null,9] → [1,3,9]. Empty tree → []. Start each max at the first node, not 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'bfs', 'dfs', 'leetcode'],
    'related_session' => 'find-largest-value-in-each-tree-row',
];
