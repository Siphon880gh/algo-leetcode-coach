<?php
declare(strict_types=1);

return [
    'title' => 'Network Recovery Pathways',
    'leetcode' => 3620,
    'difficulty' => 'Hard',
    'summary' => 'Binary search the score s: keep only edges with cost ≥ s and online endpoints, then find the cheapest 0 → n−1 path in the DAG. s works if that cost ≤ k; the largest working s is the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'network-recovery-pathways',
    'related_session' => 'network-recovery-pathways',
];
