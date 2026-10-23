<?php
declare(strict_types=1);

return [
    'title' => 'Number of Divisible Triplet Sums',
    'leetcode' => 2964,
    'difficulty' => 'Med',
    'summary' => 'Fix k (the last index) and keep a map of remainders of all pairs (i, j) with j < k; add count[(−nums[k]) mod d]. Then add pairs (i, k) to the map.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'tags' => ['hash', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-divisible-triplet-sums',
    'related_session' => 'number-of-divisible-triplet-sums',
];
