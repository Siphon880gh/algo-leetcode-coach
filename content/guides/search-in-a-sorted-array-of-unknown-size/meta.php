<?php
declare(strict_types=1);

return [
    'title' => 'Search in a Sorted Array of Unknown Size: double, then binary search',
    'leetcode' => 702,
    'difficulty' => 'Med',
    'summary' => 'Grow hi = 1, 2, 4, … until get(hi) ≥ target, which brackets the target in O(log p). Then binary search in [hi / 2, hi]; out-of-bounds reads return a huge value and behave like +∞.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['binary-search', 'interactive', 'leetcode'],
    'related_session' => 'search-in-a-sorted-array-of-unknown-size',
];
