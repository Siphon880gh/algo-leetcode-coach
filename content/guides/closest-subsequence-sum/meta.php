<?php
declare(strict_types=1);

return [
    'title' => 'Closest Subsequence Sum: meet in the middle',
    'leetcode' => 1755,
    'difficulty' => 'Hard',
    'summary' => 'n ≤ 40 is too many for 2^n, but each half has at most 2^20 subset sums. Enumerate both halves, sort one, and for each sum in the other binary search for the closest complement to goal.',
    'category' => 'LeetCode',
    'subcategory' => 'Meet in the Middle',
    'topic' => 'LeetCode · Meet in the Middle',
    'kind' => 'algo',
    'tags' => ['meet-in-the-middle', 'binary-search', 'bitmask', 'leetcode'],
    'related_session' => 'closest-subsequence-sum',
];
