<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Subsequence Score: fix the minimum, keep the k largest sums',
    'leetcode' => 2542,
    'difficulty' => 'Med',
    'summary' => 'Sort indices by nums2 from large to small. When index i is reached, it is the smallest nums2 so far, so pair it with the k largest nums1 values seen, kept in a min-heap with a running sum.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['array', 'greedy', 'sorting', 'heap', 'leetcode'],
    'related_session' => 'maximum-subsequence-score',
];
