<?php
declare(strict_types=1);

return [
    'title' => 'Peaks in Array II',
    'leetcode' => 4017,
    'difficulty' => 'Hard',
    'summary' => 'A subarray is a peak subarray if it holds some peak strictly inside. Count the complement instead: subarrays of length ≥ 3 with no inner peak. A segment tree node stores its length, the positions of its first and last peaks and the gaps between them; merging fixes up the peaks at the boundary, and point updates touch only three positions.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'tags' => ['range-tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'peaks-in-array-ii',
    'related_session' => 'peaks-in-array-ii',
];
