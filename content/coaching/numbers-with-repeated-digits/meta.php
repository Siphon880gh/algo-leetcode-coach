<?php
declare(strict_types=1);

return [
    'title' => 'Numbers With Repeated Digits: count the distinct ones',
    'leetcode' => 1012,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: count numbers in [1, n] whose digits are all distinct, using permutations for shorter lengths and a digit walk for n\'s own length, then subtract from n. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'numbers-with-repeated-digits',
    'tags' => ['math', 'combinatorics', 'digit-dp', 'step-by-step'],
];
