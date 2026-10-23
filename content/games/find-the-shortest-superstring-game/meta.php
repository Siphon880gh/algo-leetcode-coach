<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Superstring: maximize the overlaps',
    'leetcode' => 943,
    'difficulty' => 'Hard',
    'summary' => 'overlap[i][j] = longest suffix of word i that is a prefix of word j. Bitmask DP over (used words, last word) picks the order with the most total overlap.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-the-shortest-superstring',
    'related_session' => 'find-the-shortest-superstring',
];
