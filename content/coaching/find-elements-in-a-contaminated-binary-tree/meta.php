<?php
declare(strict_types=1);

return [
    'title' => 'Find Elements in a Contaminated Binary Tree: recover into a set',
    'leetcode' => 1261,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: DFS from the root with value 0, give a left child 2x + 1 and a right child 2x + 2, store every value in a set, and answer find by lookup. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'related_guide' => 'find-elements-in-a-contaminated-binary-tree',
    'tags' => ['tree', 'dfs', 'hash-table', 'design', 'step-by-step'],
];
