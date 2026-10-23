<?php
declare(strict_types=1);

return [
    'title' => 'Constructing Two Increasing Arrays: smallest next number with the right parity',
    'leetcode' => 3269,
    'difficulty' => 'Hard',
    'summary' => '0 becomes an even positive number, 1 an odd one; both arrays increase and all numbers are distinct. dp[i][j] = smallest possible largest number after the first i of nums1 and j of nums2: take the next value > dp from either array.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'constructing-two-increasing-arrays',
    'related_session' => 'constructing-two-increasing-arrays',
];
