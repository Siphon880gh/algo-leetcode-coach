<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Interval to Include Each Query',
    'leetcode' => 1851,
    'difficulty' => 'Hard',
    'summary' => 'Sort intervals by left and queries ascending. For each query push intervals starting ≤ q into a min-heap by size, pop those ending before q; the top is the answer (−1 if empty).',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'tags' => ['heap', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-interval-to-include-each-query',
    'related_session' => 'minimum-interval-to-include-each-query',
];
