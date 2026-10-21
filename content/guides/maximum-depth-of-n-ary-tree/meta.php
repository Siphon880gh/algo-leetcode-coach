<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Depth of N-ary Tree: 1 + deepest child',
    'leetcode' => 559,
    'difficulty' => 'Easy',
    'summary' => 'Depth is the number of nodes on the longest root-to-leaf path. Recursively, depth(node) = 1 + max depth over its children (1 for a leaf, 0 for null). Or BFS and count levels. [1,null,3,2,4,null,5,6] → 3. Same idea as 104.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'dfs', 'bfs', 'leetcode'],
    'related_session' => 'maximum-depth-of-n-ary-tree',
];
