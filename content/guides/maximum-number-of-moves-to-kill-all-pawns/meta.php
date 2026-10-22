<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Moves to Kill All Pawns: BFS plus minimax over masks',
    'leetcode' => 3283,
    'difficulty' => 'Hard',
    'summary' => 'BFS gives knight distances between the knight and every pawn. Then dp(mask, last) is the game value from that state: Alice maximises when an even number of pawns are gone, Bob minimises otherwise.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'breadth-first-search', 'array', 'math', 'bitmask', 'game-theory', 'leetcode'],
    'related_session' => 'maximum-number-of-moves-to-kill-all-pawns',
];
