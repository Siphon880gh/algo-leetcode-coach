<?php
declare(strict_types=1);

return [
    'title' => 'Coin Change II: coins in the outer loop',
    'leetcode' => 518,
    'difficulty' => 'Med',
    'summary' => 'Process one coin at a time: for each amount a ≥ coin, ways[a] += ways[a − coin]. Coins outside the amount loop count combinations once (1+2 and 2+1 are the same).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'coin-change-ii',
    'related_session' => 'coin-change-ii',
];
