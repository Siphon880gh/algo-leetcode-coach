<?php
declare(strict_types=1);

return [
    'title' => 'Count Prime-Gap Balanced Subarrays: sliding window over primes',
    'leetcode' => 3589,
    'difficulty' => 'Med',
    'summary' => 'For each right end, shrink the left bound until the primes in the window differ by at most k (monotonic deques over prime positions). Valid left ends run from that bound to the second-to-last prime, so add max(0, p2 − l + 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['queue', 'array', 'math', 'number-theory', 'sliding-window', 'monotonic-queue', 'leetcode'],
    'related_session' => 'count-prime-gap-balanced-subarrays',
];
