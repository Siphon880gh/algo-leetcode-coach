<?php
declare(strict_types=1);

return [
    'title' => 'Network Recovery Pathways: binary search on the score',
    'leetcode' => 3620,
    'difficulty' => 'Hard',
    'summary' => 'Binary search the score s. Keep edges with cost ≥ s and online intermediate nodes, then find the cheapest 0 → n − 1 path with a DP in topological order; s works if that cost ≤ k.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graph', 'topological-sort', 'array', 'binary-search', 'dynamic-programming', 'shortest-path', 'heap', 'leetcode'],
    'related_session' => 'network-recovery-pathways',
];
