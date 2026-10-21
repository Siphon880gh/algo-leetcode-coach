<?php
declare(strict_types=1);

return [
    'title' => 'Zuma Game: BFS over (board, hand) with smart insert positions',
    'leetcode' => 488,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: fewest insertions to clear a Zuma board, or −1. Board ≤ 16, hand ≤ 5, so BFS over (collapsed board, sorted hand), with pruned insert spots. "WWRRBBWW", "WRBRW" → 2. "WRRBBW", "RB" → −1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'tags' => ['bfs', 'memoization', 'strings', 'backtracking', 'step-by-step'],
    'related_guide' => 'zuma-game',
];
