<?php
declare(strict_types=1);

return [
    'title' => 'Out of Boundary Paths: spread counts one move at a time',
    'leetcode' => 576,
    'difficulty' => 'Med',
    'summary' => 'cnt[r][c] = ways to be at (r,c) after t moves. Each move pushes every count to its 4 neighbors; a push off the grid is an exit and adds to the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'out-of-boundary-paths',
    'related_session' => 'out-of-boundary-paths',
];
