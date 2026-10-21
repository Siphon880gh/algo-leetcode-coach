<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Time to Collect All Apples: needed edges × 2',
    'leetcode' => 1443,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: DFS from 0 tracking the parent; a child\'s edge costs 2 plus its subtree cost when that subtree has an apple. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'related_guide' => 'minimum-time-to-collect-all-apples-in-a-tree',
    'tags' => ['tree', 'dfs', 'step-by-step'],
];
