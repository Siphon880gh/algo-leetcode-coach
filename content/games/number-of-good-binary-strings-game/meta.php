<?php
declare(strict_types=1);

return [
    'title' => 'Number of Good Binary Strings: append a whole block',
    'leetcode' => 2533,
    'difficulty' => 'Med',
    'summary' => 'Each block of 1s has a length multiple of oneGroup, each block of 0s a multiple of zeroGroup, so build by appending oneGroup ones or zeroGroup zeros: dp[l] = dp[l − oneGroup] + dp[l − zeroGroup]. Sum over min to max length.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-good-binary-strings',
    'related_session' => 'number-of-good-binary-strings',
];
