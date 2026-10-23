<?php
declare(strict_types=1);

return [
    'title' => 'Find Polygon With the Largest Perimeter',
    'leetcode' => 2971,
    'difficulty' => 'Med',
    'summary' => 'Sort. Scan with a prefix sum; whenever the sum of the smaller sides exceeds the current side (with ≥ 3 sides), the prefix through it is a valid polygon — keep the last one.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-polygon-with-the-largest-perimeter',
    'related_session' => 'find-polygon-with-the-largest-perimeter',
];
