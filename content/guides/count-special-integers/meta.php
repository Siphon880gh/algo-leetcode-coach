<?php
declare(strict_types=1);

return [
    'title' => 'Count Special Integers: digit counting with a used set',
    'leetcode' => 2376,
    'difficulty' => 'Hard',
    'summary' => 'Count distinct-digit numbers shorter than n with 9 · P(9, L − 1) each, then walk n’s digits: at each position count smaller unused digits times the permutations of the remaining positions, and stop at the first repeated digit of n.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'dynamic-programming', 'leetcode'],
    'related_session' => 'count-special-integers',
];
