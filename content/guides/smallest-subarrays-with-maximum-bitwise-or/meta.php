<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Subarrays With Maximum Bitwise OR: latest position of each bit',
    'leetcode' => 2411,
    'difficulty' => 'Med',
    'summary' => 'Scan from the right keeping, for each bit, the nearest index at or after i where it is set. The OR from i can only reach those bits, so the shortest subarray must stretch to the farthest of those indices.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'bit-manipulation', 'sliding-window', 'leetcode'],
    'related_session' => 'smallest-subarrays-with-maximum-bitwise-or',
];
