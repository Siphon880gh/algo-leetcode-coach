<?php
declare(strict_types=1);

return [
    'title' => 'Random Point in Non-overlapping Rectangles: pick a rectangle by point count, then a point',
    'leetcode' => 497,
    'difficulty' => 'Med',
    'summary' => 'Return a uniform random integer point covered by some rectangle. Weight each rectangle by its integer point count (x2 − x1 + 1)(y2 − y1 + 1), build prefix sums, draw v in 1..total, binary search the rectangle, then pick x and y uniformly inside it. Picking a rectangle uniformly is wrong. Same idea as 528.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['binary-search', 'prefix-sum', 'probability', 'design', 'leetcode'],
    'related_session' => 'random-point-in-non-overlapping-rectangles',
];
