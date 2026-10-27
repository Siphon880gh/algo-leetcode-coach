<?php
declare(strict_types=1);

return [
    'title' => 'Minimize Inversions in a Prefix Tree',
    'leetcode' => 4077,
    'difficulty' => 'Hard',
    'summary' => 'Split inversions by trie node. A marked node costs its descendants with smaller target positions. Pairs inside one child belong to that child. Pairs across two children depend only on which child goes first, so compute cost(A before B) for each pair and pick the cheapest order (bitmask DP).',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'tags' => ['trie', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimize-inversions-in-a-prefix-tree',
    'related_session' => 'minimize-inversions-in-a-prefix-tree',
];
