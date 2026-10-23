<?php
declare(strict_types=1);

return [
    'title' => 'Find Building Where Alice and Bob Can Meet',
    'leetcode' => 2940,
    'difficulty' => 'Hard',
    'summary' => 'With a ≤ b: if a = b or heights[a] < heights[b], answer b. Otherwise find the leftmost j > b with heights[j] > max(heights[a], heights[b]) — offline with a monotonic stack or a segment-tree descent.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'tags' => ['range-tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-building-where-alice-and-bob-can-meet',
    'related_session' => 'find-building-where-alice-and-bob-can-meet',
];
