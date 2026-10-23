<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Moves to Kill All Pawns: knight distances + minimax',
    'leetcode' => 3283,
    'difficulty' => 'Hard',
    'summary' => 'BFS gives knight distances between the knight and every pawn. Players alternately pick a pawn to capture: Alice maximizes total moves, Bob minimizes. Memoize on (position, remaining pawns).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-number-of-moves-to-kill-all-pawns',
    'related_session' => 'maximum-number-of-moves-to-kill-all-pawns',
];
