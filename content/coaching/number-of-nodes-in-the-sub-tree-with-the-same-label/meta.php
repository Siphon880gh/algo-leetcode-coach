<?php
declare(strict_types=1);

return [
    'title' => 'Same-Label Counts in Subtrees: merge 26-counts',
    'leetcode' => 1519,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: DFS from 0 with a parent; sum the children\'s label counts, add your own, and record your label\'s count. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'related_guide' => 'number-of-nodes-in-the-sub-tree-with-the-same-label',
    'tags' => ['tree', 'dfs', 'hash-map', 'step-by-step'],
];
