<?php
declare(strict_types=1);

return [
    'title' => 'Tree Node: Root, Inner, Leaf in that order',
    'leetcode' => 608,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: check Root first, detect Inner with id IN (SELECT p_id …), and let ELSE give Leaf. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'related_guide' => 'tree-node',
    'tags' => ['database', 'sql', 'case', 'step-by-step'],
];
