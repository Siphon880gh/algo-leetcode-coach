<?php
declare(strict_types=1);

return [
    'title' => 'Ways to Make a Fair Array: prefix sums by parity',
    'leetcode' => 1664,
    'difficulty' => 'Med',
    'summary' => 'Removing index i flips the parity of everything after it. Using prefix even/odd sums, the new even sum is evenBefore + oddAfter and the new odd sum is oddBefore + evenAfter; count i where they match.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['prefix-sum', 'array', 'leetcode'],
    'related_session' => 'ways-to-make-a-fair-array',
];
