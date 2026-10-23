<?php
declare(strict_types=1);

return [
    'title' => 'Path Existence Queries in a Graph II: sorted reach plus binary lifting',
    'leetcode' => 3534,
    'difficulty' => 'Hard',
    'summary' => 'Sort nodes by value. From sorted position i, one step reaches every position up to far[i], the last j with v[j] − v[i] ≤ maxDiff. Jumping to far is always best, so binary lifting on far counts the steps between two positions.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['greedy', 'bit-manipulation', 'graph', 'array', 'two-pointers', 'binary-search', 'sorting', 'leetcode'],
    'related_session' => 'path-existence-queries-in-a-graph-ii',
];
