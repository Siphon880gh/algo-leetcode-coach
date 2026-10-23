<?php
declare(strict_types=1);

return [
    'title' => 'Maximize the Distance Between Points on a Square: unroll the border, binary search the gap',
    'leetcode' => 3464,
    'difficulty' => 'Hard',
    'summary' => 'Map each point to its distance along the border from (0, 0), sort, and binary search the answer d. With k ≥ 4 the answer is at most side, and for d ≤ side the Manhattan distance between two border points is at least d exactly when their border distance (both ways round) is.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['geometry', 'array', 'math', 'binary-search', 'sorting', 'leetcode'],
    'related_session' => 'maximize-the-distance-between-points-on-a-square',
];
