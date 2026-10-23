<?php
declare(strict_types=1);

return [
    'title' => 'Campus Bikes II: bitmask over taken bikes',
    'leetcode' => 1066,
    'difficulty' => 'Med',
    'summary' => 'f(i, mask) = cheapest way to give workers i.. bikes not in mask. Try each free bike for worker i: Manhattan distance + f(i + 1, mask | bike).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'campus-bikes-ii',
    'related_session' => 'campus-bikes-ii',
];
