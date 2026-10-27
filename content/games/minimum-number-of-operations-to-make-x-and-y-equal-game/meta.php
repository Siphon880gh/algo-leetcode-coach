<?php
declare(strict_types=1);

return [
    'title' => 'Make x and y Equal: walk to a multiple, then divide',
    'leetcode' => 2998,
    'difficulty' => 'Med',
    'summary' => 'f(x) = x at most y ? y − x : min(x − y, for d in {5, 11}: (x mod d) + 1 + f((x divided by d, rounded down)), (d − x mod d) + 1 + f((x divided by d, rounded down) + 1)).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-number-of-operations-to-make-x-and-y-equal',
    'related_session' => 'minimum-number-of-operations-to-make-x-and-y-equal',
];
