<?php
declare(strict_types=1);

return [
    'title' => 'Multi Source Flood Fill: level-by-level BFS',
    'leetcode' => 3905,
    'difficulty' => 'Med',
    'summary' => 'Spread from every source at once, one level at a time. A cell first reached at level t + 1 can still be reached by other level-t cells, so keep the max color among them.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['breadth-first-search', 'array', 'matrix', 'leetcode'],
    'related_session' => 'multi-source-flood-fill',
];
