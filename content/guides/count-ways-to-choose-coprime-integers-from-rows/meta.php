<?php
declare(strict_types=1);

return [
    'title' => 'Count Ways to Choose Coprime Integers from Rows: subtract multiples',
    'leetcode' => 3725,
    'difficulty' => 'Hard',
    'summary' => 'f(d) = product over rows of how many entries d divides. The number of choices with gcd exactly d is f(d) minus the exact counts for multiples of d. Work from the largest d down and return the count for 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'dynamic-programming', 'combinatorics', 'matrix', 'number-theory', 'leetcode'],
    'related_session' => 'count-ways-to-choose-coprime-integers-from-rows',
];
