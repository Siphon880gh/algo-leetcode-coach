<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Stability Factor of Array: binary search plus greedy breaks',
    'leetcode' => 3605,
    'difficulty' => 'Hard',
    'summary' => 'Binary search the answer L. For a given L, scan left to right; whenever the last L + 1 elements since the previous change have gcd ≥ 2, change the rightmost one (to 1). L works if that takes at most maxC changes.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['greedy', 'segment-tree', 'array', 'math', 'binary-search', 'number-theory', 'leetcode'],
    'related_session' => 'minimum-stability-factor-of-array',
];
