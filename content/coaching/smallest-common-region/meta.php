<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Common Region: parents and ancestors',
    'leetcode' => 1257,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: map each region to its parent, collect region1 and all its ancestors, and walk up from region2 until one of them appears. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'related_guide' => 'smallest-common-region',
    'tags' => ['tree', 'hash-table', 'lowest-common-ancestor', 'step-by-step'],
];
