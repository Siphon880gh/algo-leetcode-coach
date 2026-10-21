<?php
declare(strict_types=1);

return [
    'title' => 'Random Point in Non-overlapping Rectangles: pick a rectangle by point count, then a point',
    'leetcode' => 497,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: a uniform random integer point from non-overlapping rectangles. Weight each rectangle by (x2 − x1 + 1)(y2 − y1 + 1), prefix sums, draw v, binary search the rectangle, then pick x and y uniformly inside. Same idea as 528. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'prefix-sum', 'probability', 'design', 'step-by-step'],
    'related_guide' => 'random-point-in-non-overlapping-rectangles',
];
