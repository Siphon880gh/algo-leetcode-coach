<?php
declare(strict_types=1);

return [
    'title' => 'Make the Prefix Sum Non-negative',
    'leetcode' => 2599,
    'difficulty' => 'Med',
    'summary' => 'Scan with a running prefix and a min-heap of negatives seen. Whenever the prefix drops below 0, move the most negative element to the end (pop it, add it back) and count one move.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'tags' => ['heap', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'make-the-prefix-sum-non-negative',
    'related_session' => 'make-the-prefix-sum-non-negative',
];
