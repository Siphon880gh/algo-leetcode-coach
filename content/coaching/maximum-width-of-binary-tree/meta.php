<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Width of Binary Tree: number the positions',
    'leetcode' => 662,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: give each node a heap index (2i and 2i + 1), take last − first + 1 per level, and re-base each level to keep the numbers small. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'maximum-width-of-binary-tree',
    'tags' => ['trees', 'bfs', 'binary-tree', 'step-by-step'],
];
