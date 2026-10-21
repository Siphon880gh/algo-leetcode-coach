<?php
declare(strict_types=1);

return [
    'title' => 'Diameter of Binary Tree: best left height + right height at any node',
    'leetcode' => 543,
    'difficulty' => 'Easy',
    'summary' => 'Longest path (in edges) between any two nodes. The path bends at some node, so it equals left height + right height there. DFS returns each node\'s height (1 + max of children, 0 for null) and updates a global best with left + right. [1,2,3,4,5] → 3. [1,2] → 1. Not always through the root.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'dfs', 'leetcode'],
    'related_session' => 'diameter-of-binary-tree',
];
