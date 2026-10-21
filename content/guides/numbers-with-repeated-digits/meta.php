<?php
declare(strict_types=1);

return [
    'title' => 'Numbers With Repeated Digits: count the complement',
    'leetcode' => 1012,
    'difficulty' => 'Hard',
    'summary' => 'Count the numbers in [1, n] whose digits are all distinct, then subtract from n. Shorter lengths are 9 · P(9, L − 1); for n\'s own length, walk its digits and count smaller distinct choices with permutations of the remaining digits.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'combinatorics', 'digit-dp', 'leetcode'],
    'related_session' => 'numbers-with-repeated-digits',
];
