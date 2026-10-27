<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Stability Factor of Array',
    'leetcode' => 3605,
    'difficulty' => 'Hard',
    'summary' => 'Binary search the answer L. To keep every stable run at most L, scan left to right: when the last L + 1 elements (since the last change) share a gcd at least 2, change the current element and restart after it. L works if the changes fit in maxC.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-stability-factor-of-array',
    'related_session' => 'minimum-stability-factor-of-array',
];
