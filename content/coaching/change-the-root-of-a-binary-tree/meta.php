<?php
declare(strict_types=1);

return [
    'title' => 'Change the Root: walk up and flip',
    'leetcode' => 1666,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: from the leaf upward, detach cur from its parent, move cur.left to the right if present, make the old parent cur.left, and set parent pointers. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'related_guide' => 'change-the-root-of-a-binary-tree',
    'tags' => ['tree', 'binary-tree', 'step-by-step'],
];
