<?php
declare(strict_types=1);

return [
    'title' => 'Non-negative Integers without Consecutive Ones: Fibonacci over the bits',
    'leetcode' => 600,
    'difficulty' => 'Hard',
    'summary' => 'The count of k-bit strings with no two adjacent 1s is a Fibonacci number. Walk n from the top bit down; each 1 bit adds the count for the bits below it, stopping at a second 1 in a row.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'bit-manipulation', 'digit-dp', 'leetcode'],
    'related_session' => 'non-negative-integers-without-consecutive-ones',
];
