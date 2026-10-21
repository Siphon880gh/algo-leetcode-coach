<?php
declare(strict_types=1);

return [
    'title' => 'Zuma Game: BFS over (board, hand) with smart insert positions',
    'leetcode' => 488,
    'difficulty' => 'Hard',
    'summary' => 'Insert balls from hand into the board; any run of 3+ same color vanishes, with chain reactions. Fewest insertions to clear the board, or −1. Board ≤ 16, hand ≤ 5, so search all states: BFS (or memo DFS) on (board after collapse, sorted hand). Prune inserts: only next to a same-color ball, or between two equal balls of another color. "WWRRBBWW", "WRBRW" → 2.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'kind' => 'algo',
    'tags' => ['bfs', 'backtracking', 'memoization', 'strings', 'leetcode'],
    'related_session' => 'zuma-game',
];
