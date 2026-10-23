<?php
declare(strict_types=1);

return [
    'title' => 'Longest Special Path II: the two latest repeat starts',
    'leetcode' => 3486,
    'difficulty' => 'Hard',
    'summary' => 'On a root-to-node path, a repeated value gives a pair (previous depth, current depth). A downward window may hold at most one such pair, so it must start after the second largest pair start. Pass the top two pair starts down the DFS.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['tree', 'depth-first-search', 'array', 'hash-table', 'prefix-sum', 'leetcode'],
    'related_session' => 'longest-special-path-ii',
];
