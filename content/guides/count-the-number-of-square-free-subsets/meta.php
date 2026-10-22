<?php
declare(strict_types=1);

return [
    'title' => 'Count the Number of Square-Free Subsets: masks over ten primes',
    'leetcode' => 2572,
    'difficulty' => 'Med',
    'summary' => 'Values are at most 30, so only the ten primes up to 29 matter. Skip values divisible by 4, 9 or 25; each other value is a prime mask. A DP over masks adds each value once per copy, and every 1 doubles the count.',
    'category' => 'LeetCode',
    'subcategory' => 'Bitmask DP',
    'topic' => 'LeetCode · Bitmask DP',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'dynamic-programming', 'bit-manipulation', 'bitmask', 'leetcode'],
    'related_session' => 'count-the-number-of-square-free-subsets',
];
