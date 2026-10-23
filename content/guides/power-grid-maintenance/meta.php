<?php
declare(strict_types=1);

return [
    'title' => 'Power Grid Maintenance: union-find with a heap per grid',
    'leetcode' => 3607,
    'difficulty' => 'Med',
    'summary' => 'Grids never change, so union-find them once. Each grid keeps a min-heap of its stations; going offline only marks the station, and a check pops offline stations off the top lazily.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'kind' => 'algo',
    'tags' => ['depth-first-search', 'breadth-first-search', 'union-find', 'graph', 'array', 'hash-table', 'ordered-set', 'heap', 'leetcode'],
    'related_session' => 'power-grid-maintenance',
];
