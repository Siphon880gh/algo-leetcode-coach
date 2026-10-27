<?php
declare(strict_types=1);

return [
    'title' => 'Longest Balanced Substring II',
    'leetcode' => 3714,
    'difficulty' => 'Med',
    'summary' => 'Three cases. One letter: longest run. Two letters x, y: inside stretches without the third letter, the first and last index with equal prefix difference (x − y) bound a balanced piece. All three: hash the pair (a − b, b − c) of prefix counts and keep its first index.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'tags' => ['hash', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'longest-balanced-substring-ii',
    'related_session' => 'longest-balanced-substring-ii',
];
