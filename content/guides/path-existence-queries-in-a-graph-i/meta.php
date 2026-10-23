<?php
declare(strict_types=1);

return [
    'title' => 'Path Existence Queries in a Graph I: gaps split the sorted array',
    'leetcode' => 3532,
    'difficulty' => 'Med',
    'summary' => 'nums is sorted, so i and i + 1 connect when their gap ≤ maxDiff, and any longer edge can be replaced by a chain of these. A component id that increases at each big gap answers each query in O(1).',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'kind' => 'algo',
    'tags' => ['union-find', 'graph', 'array', 'hash-table', 'binary-search', 'leetcode'],
    'related_session' => 'path-existence-queries-in-a-graph-i',
];
