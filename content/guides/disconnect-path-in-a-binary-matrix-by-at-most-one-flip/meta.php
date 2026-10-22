<?php
declare(strict_types=1);

return [
    'title' => 'Disconnect Path in a Binary Matrix by at Most One Flip: two greedy paths',
    'leetcode' => 2556,
    'difficulty' => 'Med',
    'summary' => 'Find any path by DFS, erasing its cells as you go. Then search again. If the second search fails, the paths all share a cell, which one flip can block; if it succeeds, two cell-disjoint paths exist and one flip is not enough.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'depth-first-search', 'matrix', 'leetcode'],
    'related_session' => 'disconnect-path-in-a-binary-matrix-by-at-most-one-flip',
];
