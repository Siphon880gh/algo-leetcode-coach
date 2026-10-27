<?php
declare(strict_types=1);

return [
    'title' => 'Count Special Integers: distinct digits up to n',
    'leetcode' => 2376,
    'difficulty' => 'Hard',
    'summary' => 'Shorter lengths L: 9 times P(9, L − 1). Same length: at each position, count unused smaller digits (no leading zero) times P(remaining digits, remaining positions); stop if n repeats a digit; add 1 if n itself is special.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-special-integers',
    'related_session' => 'count-special-integers',
];
