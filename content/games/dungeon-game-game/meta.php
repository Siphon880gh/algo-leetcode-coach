<?php
declare(strict_types=1);

return [
    'title' => 'Dungeon Game: plan health backwards from the princess',
    'leetcode' => 174,
    'difficulty' => 'Hard',
    'summary' => 'need[i][j] = least health on entering (i,j). From the end: need = max(1, min(need below, need right) − dungeon[i][j]).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'dungeon-game',
    'related_session' => 'dungeon-game',
];
