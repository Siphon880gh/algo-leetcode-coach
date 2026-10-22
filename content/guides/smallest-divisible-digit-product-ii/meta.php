<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Divisible Digit Product II: keep the longest prefix, then fill minimally',
    'leetcode' => 3348,
    'difficulty' => 'Hard',
    'summary' => 't must factor into 2, 3, 5 and 7. From the right, keep a zero-free prefix of num, raise one digit, and fill the rest with 1s plus the fewest digits that cover what t still needs. If no prefix works, use a longer number.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'math', 'string', 'backtracking', 'number-theory', 'leetcode'],
    'related_session' => 'smallest-divisible-digit-product-ii',
];
