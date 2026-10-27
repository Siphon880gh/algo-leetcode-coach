<?php
declare(strict_types=1);

return [
    'title' => 'Find Sorted Submatrices With Maximum Element at Most K',
    'leetcode' => 3359,
    'difficulty' => 'Hard',
    'summary' => 'For each cell, compute how far right the row stays at most k and non-increasing. Then for each column, count submatrices whose top-left is there using a monotonic stack over those widths going down rows (histogram counting).',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'tags' => ['mono-stack', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-sorted-submatrices-with-maximum-element-at-most-k',
    'related_session' => 'find-sorted-submatrices-with-maximum-element-at-most-k',
];
