<?php
declare(strict_types=1);

return [
    'title' => 'The Number of Good Subsets: bitmask DP over primes up to 30',
    'leetcode' => 1994,
    'difficulty' => 'Hard',
    'summary' => 'Only 10 primes are below 30. Skip numbers with a squared prime factor, map the rest to prime masks, and run a subset DP over masks weighted by counts. Each 1 can be added freely: multiply by 2^count(1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'bitmask', 'math', 'leetcode'],
    'related_session' => 'the-number-of-good-subsets',
];
