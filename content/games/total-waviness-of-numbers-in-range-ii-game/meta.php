<?php
declare(strict_types=1);

return [
    'title' => 'Total Waviness of Numbers in Range II',
    'leetcode' => 3753,
    'difficulty' => 'Hard',
    'summary' => 'Up to 1e15: digit DP for f(N) = total waviness of 1..N, state (position, previous two digits, tight, started), returning (count of numbers, total waviness). The answer is f(num2) − f(num1 − 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'total-waviness-of-numbers-in-range-ii',
    'related_session' => 'total-waviness-of-numbers-in-range-ii',
];
