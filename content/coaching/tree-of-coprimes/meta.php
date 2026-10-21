<?php
declare(strict_types=1);

return [
    'title' => 'Tree of Coprimes: DFS with a stack per value',
    'leetcode' => 1766,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: keep a stack of (node, depth) per value 1 … 50 for the current root path; at each node choose the deepest top among values coprime with its own. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'related_guide' => 'tree-of-coprimes',
    'tags' => ['tree', 'depth-first-search', 'math', 'step-by-step'],
];
