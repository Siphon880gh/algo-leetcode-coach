<?php
declare(strict_types=1);

return [
    'title' => 'Minimize the Maximum Adjacent Element Difference: binary search with x and y fixed',
    'leetcode' => 3357,
    'difficulty' => 'Hard',
    'summary' => 'Binary search the answer d. With lo and hi the smallest and largest known neighbours of a gap, the best pair is x = lo + d and y = hi − d. Check each gap: one value fits both ends, or a gap of 2+ cells uses x and y when |x − y| ≤ d.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'binary-search', 'leetcode'],
    'related_session' => 'minimize-the-maximum-adjacent-element-difference',
];
