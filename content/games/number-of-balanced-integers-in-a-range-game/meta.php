<?php
declare(strict_types=1);

return [
    'title' => 'Number of Balanced Integers in a Range',
    'leetcode' => 3791,
    'difficulty' => 'Hard',
    'summary' => 'Digit DP for count(at most N): state (position, odd-sum − even-sum offset, tight, started), counting numbers with at least two digits whose offset ends at 0. The answer is count(high) − count(low − 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-balanced-integers-in-a-range',
    'related_session' => 'number-of-balanced-integers-in-a-range',
];
