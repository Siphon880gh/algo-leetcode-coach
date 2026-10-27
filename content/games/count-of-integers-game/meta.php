<?php
declare(strict_types=1);

return [
    'title' => 'Count of Integers: digit DP with a digit-sum window',
    'leetcode' => 2719,
    'difficulty' => 'Hard',
    'summary' => 'count(N) = numbers in [0, N] with min_sum at most digit sum at most max_sum, by digit DP (position, sum, tight). Answer = count(num2) − count(num1) + (num1 is good).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-of-integers',
    'related_session' => 'count-of-integers',
];
