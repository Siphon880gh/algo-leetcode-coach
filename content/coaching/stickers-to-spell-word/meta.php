<?php
declare(strict_types=1);

return [
    'title' => 'Stickers to Spell Word: BFS on covered positions',
    'leetcode' => 691,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: a bitmask of covered target letters is the state, stickers fill it greedily, and only stickers with the first missing letter are tried. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'stickers-to-spell-word',
    'tags' => ['dynamic-programming', 'bitmask', 'bfs', 'memoization', 'step-by-step'],
];
