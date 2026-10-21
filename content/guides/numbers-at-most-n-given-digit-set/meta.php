<?php
declare(strict_types=1);

return [
    'title' => 'Numbers At Most N Given Digit Set: shorter numbers, then digit by digit',
    'leetcode' => 902,
    'difficulty' => 'Hard',
    'summary' => 'Every number with fewer digits than n counts: d + d² + … for d allowed digits. For the same length, walk n\'s digits: add (allowed digits smaller than this one) × d^(remaining); continue only while n\'s digit is allowed.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'dynamic-programming', 'digit-dp', 'leetcode'],
    'related_session' => 'numbers-at-most-n-given-digit-set',
];
