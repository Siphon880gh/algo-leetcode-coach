<?php
declare(strict_types=1);

return [
    'title' => 'Maximize the Distance Between Points on a Square',
    'leetcode' => 3464,
    'difficulty' => 'Hard',
    'summary' => 'Unroll the boundary into a line of length 4 times side; for answers at most side, Manhattan distance equals the perimeter distance. Binary search d: from each start, greedily jump to the next point at least d further (binary search), k − 1 times, and check the wrap-around gap.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximize-the-distance-between-points-on-a-square',
    'related_session' => 'maximize-the-distance-between-points-on-a-square',
];
