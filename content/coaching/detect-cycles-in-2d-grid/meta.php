<?php
declare(strict_types=1);

return [
    'title' => 'Detect Cycles in 2D Grid: union-find',
    'leetcode' => 1559,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: union each cell with same-letter right and down neighbours; joining two cells already connected means a cycle. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'related_guide' => 'detect-cycles-in-2d-grid',
    'tags' => ['union-find', 'dfs', 'matrix', 'step-by-step'],
];
