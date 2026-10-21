<?php
declare(strict_types=1);

return [
    'title' => 'Amount of New Area Painted Each Day: skip painted cells with a jump pointer',
    'leetcode' => 2158,
    'difficulty' => 'Hard',
    'summary' => 'Keep next[x] pointing past already-painted units, compressed like union-find. Each day, jump from start to the next unpainted unit, paint it, link it to x + 1, and repeat until end. Each unit is painted once.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'kind' => 'algo',
    'tags' => ['union-find', 'array', 'leetcode'],
    'related_session' => 'amount-of-new-area-painted-each-day',
];
