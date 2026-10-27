<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Inversion Count in Subarrays of Fixed Length',
    'leetcode' => 3768,
    'difficulty' => 'Hard',
    'summary' => 'Slide a window of size k with a Fenwick tree over compressed values. Dropping the left element removes the inversions it starts (smaller elements in the window); adding the right element adds the larger elements already inside.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'tags' => ['range-tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-inversion-count-in-subarrays-of-fixed-length',
    'related_session' => 'minimum-inversion-count-in-subarrays-of-fixed-length',
];
