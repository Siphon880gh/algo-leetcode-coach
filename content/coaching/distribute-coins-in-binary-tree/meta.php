<?php
declare(strict_types=1);

return [
    'title' => 'Distribute Coins in Binary Tree: edge traffic',
    'leetcode' => 979,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: each subtree returns its excess (coins − nodes); that many coins cross the edge to the parent, so add |left| + |right| at every node. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'distribute-coins-in-binary-tree',
    'tags' => ['trees', 'depth-first-search', 'step-by-step'],
];
