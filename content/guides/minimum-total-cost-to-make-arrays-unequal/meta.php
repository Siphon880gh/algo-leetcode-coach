<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Total Cost to Make Arrays Unequal: pay for every clash, borrow while one value dominates',
    'leetcode' => 2499,
    'difficulty' => 'Hard',
    'summary' => 'Every index with nums1[i] = nums2[i] must move, so their indices are a lower bound. They can fix each other unless one value fills more than half of them; then borrow the smallest other indices where neither array holds that value.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'greedy', 'counting', 'leetcode'],
    'related_session' => 'minimum-total-cost-to-make-arrays-unequal',
];
