<?php
declare(strict_types=1);

return [
    'title' => 'Sum of K-Digit Numbers in a Range: count each digit place',
    'leetcode' => 3855,
    'difficulty' => 'Hard',
    'summary' => 'Each of the k places shows each digit in [l, r] equally often, c^(k − 1) times with c = r − l + 1. So the sum is S · c^(k − 1) · 11…1 (k ones), where S = l + … + r. The repunit is (10^k − 1) / 9, using the inverse of 9 mod 10^9 + 7.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'divide-and-conquer', 'combinatorics', 'number-theory', 'leetcode'],
    'related_session' => 'sum-of-k-digit-numbers-in-a-range',
];
