<?php
declare(strict_types=1);

return [
    'title' => 'Check Completeness of a Binary Tree: no node after a null',
    'leetcode' => 958,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: run a level-order traversal that also enqueues nulls; after the first null, any real node means the tree is not complete. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'check-completeness-of-a-binary-tree',
    'tags' => ['trees', 'bfs', 'step-by-step'],
];
