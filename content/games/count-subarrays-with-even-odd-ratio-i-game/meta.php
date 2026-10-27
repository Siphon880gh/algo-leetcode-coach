<?php
declare(strict_types=1);

return [
    'title' => 'Count Subarrays With Even Odd Ratio I',
    'leetcode' => 4011,
    'difficulty' => 'Med',
    'summary' => 'x divided by y at most a divided by b exactly when b times x − a times y at most 0. Score evens as +b and odds as −a; a subarray is valid when its sum is at most 0 (that forces y > 0). So count pairs l < r with P[l] at least P[r], using a Fenwick tree over compressed prefix sums or merge sort.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-subarrays-with-even-odd-ratio-i',
    'related_session' => 'count-subarrays-with-even-odd-ratio-i',
];
