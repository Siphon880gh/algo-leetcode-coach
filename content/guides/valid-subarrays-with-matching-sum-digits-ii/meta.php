<?php
declare(strict_types=1);

return [
    'title' => 'Valid Subarrays With Matching Sum Digits II: prefix sums by digit count',
    'leetcode' => 3972,
    'difficulty' => 'Hard',
    'summary' => 'Values are positive, so prefix sums increase. For each right end and each length d of the sum, the sums starting with x form one range of left ends; binary search it and count left ends with the right residue mod 10 using per-residue prefix counts.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'prefix-sum', 'sliding-window', 'leetcode'],
    'related_session' => 'valid-subarrays-with-matching-sum-digits-ii',
];
