<?php
declare(strict_types=1);

return [
    'title' => 'N-ary Tree Postorder Traversal: children, then the node',
    'leetcode' => 590,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: recurse into the children then record the node; iteratively, collect node-first with the children pushed in order and reverse at the end. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'n-ary-tree-postorder-traversal',
    'tags' => ['trees', 'dfs', 'stack', 'step-by-step'],
];
