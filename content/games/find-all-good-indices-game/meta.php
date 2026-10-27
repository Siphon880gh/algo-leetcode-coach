<?php
declare(strict_types=1);

return [
    'title' => 'Find All Good Indices: k non-increasing before, k non-decreasing after',
    'leetcode' => 2420,
    'difficulty' => 'Med',
    'summary' => 'dec[i] = non-increasing run length ending at i; inc[i] = non-decreasing run starting at i. Index i is good if dec[i−1] at least k and inc[i+1] at least k.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-all-good-indices',
    'related_session' => 'find-all-good-indices',
];
