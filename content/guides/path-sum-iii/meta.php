<?php
declare(strict_types=1);

return [
    'title' => 'Path Sum III: prefix sums on the root-to-node path',
    'leetcode' => 437,
    'difficulty' => 'Med',
    'summary' => 'Count downward paths (any start, any end) whose values sum to targetSum. DFS with a running prefix sum and a hash map of prefix counts on the current root path; add count[s − target] at each node, undo on the way back. [10,5,-3,3,2,null,11,3,-2,null,1], 8 → 3. Not 112 / 113 (root-to-leaf).',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'dfs', 'prefix-sum', 'hash-table', 'leetcode'],
    'related_session' => 'path-sum-iii',
];
