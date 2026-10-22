<?php
declare(strict_types=1);

return [
    'title' => 'Longest Nice Subarray: window of disjoint bits',
    'leetcode' => 2401,
    'difficulty' => 'Med',
    'summary' => 'A subarray is nice exactly when no bit is set in two of its numbers, so keep a window and the OR of its numbers. Before adding a number that shares a bit, drop numbers from the left by XOR.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['array', 'bit-manipulation', 'sliding-window', 'leetcode'],
    'related_session' => 'longest-nice-subarray',
];
