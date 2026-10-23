<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Factorization: divide by 9 down to 2',
    'leetcode' => 625,
    'difficulty' => 'Med',
    'summary' => 'num < 10 is its own answer. Otherwise divide out 9, 8, …, 2 greedily (bigger digits mean fewer digits), then write the digits in increasing order. Leftover > 1 or overflow → 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-factorization',
    'related_session' => 'minimum-factorization',
];
