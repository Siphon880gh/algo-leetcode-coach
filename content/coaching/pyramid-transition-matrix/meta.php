<?php
declare(strict_types=1);

return [
    'title' => 'Pyramid Transition Matrix: memoize failing rows',
    'leetcode' => 756,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: map each pair to its allowed tops, build the next row by DFS over positions, recurse, and memoize rows. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'related_guide' => 'pyramid-transition-matrix',
    'tags' => ['backtracking', 'memoization', 'hash-map', 'step-by-step'],
];
