<?php
declare(strict_types=1);

return [
    'title' => 'Subtree Removal Game with Fibonacci Tree: Grundy values repeat',
    'leetcode' => 2005,
    'difficulty' => 'Hard',
    'summary' => 'This is tree Hackenbush: Grundy(T) = XOR over children of (Grundy(child) + 1). For the Fibonacci tree g(n) = (g(n − 2) + 1) XOR (g(n − 1) + 1), which is 0 exactly when n % 6 == 1. Alice wins iff n % 6 != 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Game Theory',
    'topic' => 'LeetCode · Game Theory',
    'kind' => 'algo',
    'tags' => ['game-theory', 'math', 'tree', 'leetcode'],
    'related_session' => 'subtree-removal-game-with-fibonacci-tree',
];
