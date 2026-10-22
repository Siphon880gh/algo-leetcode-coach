<?php
declare(strict_types=1);

return [
    'title' => 'Longest Special Path: DFS with a window over the root path',
    'leetcode' => 3425,
    'difficulty' => 'Hard',
    'summary' => 'Walk the tree keeping the root-to-node path, prefix distances, and the deepest depth of each value on it. The special path ending at a node starts just below the last repeat, and that start never moves back up.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['tree', 'depth-first-search', 'array', 'hash-table', 'prefix-sum', 'leetcode'],
    'related_session' => 'longest-special-path',
];
