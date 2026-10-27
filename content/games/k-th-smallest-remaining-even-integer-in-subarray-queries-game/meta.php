<?php
declare(strict_types=1);

return [
    'title' => 'K-th Smallest Remaining Even Integer in Subarray Queries',
    'leetcode' => 3911,
    'difficulty' => 'Hard',
    'summary' => 'Binary search the answer 2t: the evens ≤ 2t are t, minus the even values of nums[l..r] that are ≤ 2t (a prefix count of evens plus binary search, since nums is increasing). Find the smallest t whose remaining count is ≥ k.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'k-th-smallest-remaining-even-integer-in-subarray-queries',
    'related_session' => 'k-th-smallest-remaining-even-integer-in-subarray-queries',
];
