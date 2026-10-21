<?php
declare(strict_types=1);

return [
    'title' => 'Complete Binary Tree Inserter: a queue of open parents',
    'leetcode' => 919,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep the nodes missing a child in level order; insert under the front one, pop it once full, and enqueue the new node. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'complete-binary-tree-inserter',
    'tags' => ['trees', 'bfs', 'design', 'step-by-step'],
];
