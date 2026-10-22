<?php
declare(strict_types=1);

return [
    'title' => 'Create Components With Same Value: most parts first, cut at the target',
    'leetcode' => 2440,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: try component counts from n down so the first success is the best, and return 0 to the parent whenever a subtree reaches the target. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'create-components-with-same-value',
    'tags' => ['array', 'math', 'tree', 'depth-first-search', 'enumeration', 'step-by-step'],
];
