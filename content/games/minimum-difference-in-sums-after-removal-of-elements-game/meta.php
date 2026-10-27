<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Difference After Removal: smallest n on the left, largest n on the right',
    'leetcode' => 2163,
    'difficulty' => 'Hard',
    'summary' => 'For each split k (k from n to 2n): left[k] = sum of the n smallest in nums[0 to k) (max-heap), right[k] = sum of the n largest in nums[k..) (min-heap). Answer = min left[k] − right[k].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-difference-in-sums-after-removal-of-elements',
    'related_session' => 'minimum-difference-in-sums-after-removal-of-elements',
];
