<?php
declare(strict_types=1);

return [
    'title' => 'Count Valid Paths in a Tree: non-prime components around each prime',
    'leetcode' => 2867,
    'difficulty' => 'Hard',
    'summary' => 'Remove the primes; the rest split into components. For each prime, its neighbouring components with sizes z give paths that end at the prime (Σ z) and paths through it (pairs of components).',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['math', 'dynamic-programming', 'tree', 'depth-first-search', 'number-theory', 'leetcode'],
    'related_session' => 'count-valid-paths-in-a-tree',
];
