<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Moves to Kill All Pawns: BFS plus minimax',
    'leetcode' => 3283,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: knight distances, then a mask DP with alternating turns. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'maximum-number-of-moves-to-kill-all-pawns',
    'tags' => ['bit-manipulation', 'breadth-first-search', 'array', 'math', 'bitmask', 'game-theory', 'step-by-step'],
];
