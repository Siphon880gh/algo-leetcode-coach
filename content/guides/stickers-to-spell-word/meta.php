<?php
declare(strict_types=1);

return [
    'title' => 'Stickers to Spell Word: BFS over which target letters are covered',
    'leetcode' => 691,
    'difficulty' => 'Hard',
    'summary' => 'The target has at most 15 letters, so a bitmask of covered positions is the state. BFS from mask 0, apply each sticker greedily to fill missing positions, and only try stickers that cover the first missing letter.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'bitmask', 'bfs', 'memoization', 'leetcode'],
    'related_session' => 'stickers-to-spell-word',
];
