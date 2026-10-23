<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Repunit Divisible by K: track the remainder',
    'leetcode' => 1015,
    'difficulty' => 'Med',
    'summary' => 'If k is divisible by 2 or 5, no number of 1s works. Otherwise update r = (r · 10 + 1) mod k; within k steps r hits 0 (pigeonhole). The step count is the length.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'smallest-integer-divisible-by-k',
    'related_session' => 'smallest-integer-divisible-by-k',
];
