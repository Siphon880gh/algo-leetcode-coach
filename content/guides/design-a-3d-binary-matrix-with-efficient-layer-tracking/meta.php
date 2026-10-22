<?php
declare(strict_types=1);

return [
    'title' => 'Design a 3D Binary Matrix with Efficient Layer Tracking: counts and a lazy heap',
    'leetcode' => 3391,
    'difficulty' => 'Med',
    'summary' => 'Keep the set of 1 cells, a count per layer, and a max-heap of (count, x) with lazy deletion: push a fresh entry on every change and discard tops whose count is stale.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'array', 'hash-table', 'matrix', 'ordered-set', 'heap', 'leetcode'],
    'related_session' => 'design-a-3d-binary-matrix-with-efficient-layer-tracking',
];
