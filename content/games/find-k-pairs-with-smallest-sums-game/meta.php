<?php
declare(strict_types=1);

return [
    'title' => 'Find K Pairs with Smallest Sums',
    'leetcode' => 373,
    'difficulty' => 'Med',
    'summary' => 'Min-heap seeded with (nums1[i] + nums2[0], i, 0). Pop the smallest k times; after popping (i, j) push (i, j + 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'tags' => ['two-pointers', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-k-pairs-with-smallest-sums',
    'related_session' => 'find-k-pairs-with-smallest-sums',
];
