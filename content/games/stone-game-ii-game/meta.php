<?php
declare(strict_types=1);

return [
    'title' => 'Stone Game II: take up to 2M piles',
    'leetcode' => 1140,
    'difficulty' => 'Med',
    'summary' => 'f(i, M) = most stones the player to move can get from piles i..end. Take X piles (1 ≤ X ≤ 2M): suffix(i) − f(i + X, max(M, X)). If 2M covers the rest, take everything.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'stone-game-ii',
    'related_session' => 'stone-game-ii',
];
