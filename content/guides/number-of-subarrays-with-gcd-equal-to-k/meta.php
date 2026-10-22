<?php
declare(strict_types=1);

return [
    'title' => 'Number of Subarrays With GCD Equal to K: extend each start, stop when k no longer divides',
    'leetcode' => 2447,
    'difficulty' => 'Med',
    'summary' => 'For every start, extend the subarray to the right while keeping the running GCD, counting ends where it equals k. Stop as soon as the GCD is not a multiple of k, since it can only shrink further.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'number-theory', 'leetcode'],
    'related_session' => 'number-of-subarrays-with-gcd-equal-to-k',
];
