<?php
declare(strict_types=1);

return [
    'title' => 'Count of Integers: digit DP on both bounds',
    'leetcode' => 2719,
    'difficulty' => 'Hard',
    'summary' => 'Count numbers up to a bound with digit sum in range using a digit DP over (position, sum so far, tight). The answer is count(num2) − count(num1), plus num1 itself if it is good.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['math', 'string', 'dynamic-programming', 'leetcode'],
    'related_session' => 'count-of-integers',
];
