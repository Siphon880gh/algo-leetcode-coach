<?php
declare(strict_types=1);

return [
    'title' => 'Path Sum III: prefix sums on the root-to-node path',
    'leetcode' => 437,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: count downward paths with sum targetSum (any start, any end). DFS with running prefix sum s and a map of prefix counts on the current root path, seeded with 0 → 1. Add count[s − target], recurse, then undo. [10,5,-3,3,2,null,11,3,-2,null,1], 8 → 3. Not 112 / 113. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['trees', 'dfs', 'prefix-sum', 'hash-table', 'step-by-step'],
    'related_guide' => 'path-sum-iii',
];
