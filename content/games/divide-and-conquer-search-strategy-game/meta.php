<?php
declare(strict_types=1);

return [
    'title' => 'Divide and Conquer Search',
    'summary' => 'Binary search on a sorted array keeps a live range [lo, hi]. Look at mid = (lo + hi) divided by 2 rounded down: equal means found; if the target is larger drop the left half (lo = mid + 1), else drop the right half (hi = mid − 1). Empty range means not found (−1).',
    'category' => 'Algorithms',
    'subcategory' => 'Binary Search',
    'topic' => 'Algorithms · Binary Search',
    'tags' => ['binary-search', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'divide-and-conquer-search-strategy',
    'related_session' => 'divide-and-conquer-search-strategy',
];
