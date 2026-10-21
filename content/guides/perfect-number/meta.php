<?php
declare(strict_types=1);

return [
    'title' => 'Perfect Number: sum divisor pairs up to sqrt(num)',
    'leetcode' => 507,
    'difficulty' => 'Easy',
    'summary' => 'A perfect number equals the sum of its proper divisors. Loop i from 2 while i × i <= num; when i divides num, add i and num / i (once if they are equal). Start the sum at 1 and treat num = 1 as false. 28 → true. 7 → false.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'leetcode'],
    'related_session' => 'perfect-number',
];
