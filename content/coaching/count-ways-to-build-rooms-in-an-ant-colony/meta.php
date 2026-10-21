<?php
declare(strict_types=1);

return [
    'title' => 'Count Ways to Build Rooms: n! over subtree sizes',
    'leetcode' => 1916,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: compute subtree sizes iteratively, then n! · Π inverse(size) mod p. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Combinatorics',
    'topic' => 'LeetCode · Combinatorics',
    'related_guide' => 'count-ways-to-build-rooms-in-an-ant-colony',
    'tags' => ['combinatorics', 'tree', 'dfs', 'math', 'step-by-step'],
];
