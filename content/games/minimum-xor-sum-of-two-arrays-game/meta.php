<?php
declare(strict_types=1);

return [
    'title' => 'Minimum XOR Sum: assign nums2 with a bitmask',
    'leetcode' => 1879,
    'difficulty' => 'Hard',
    'summary' => 'f(i, mask) = cheapest way to pair nums1[i..] with the unused nums2 elements. Try every free j: (nums1[i] XOR nums2[j]) + f(i + 1, mask | j).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-xor-sum-of-two-arrays',
    'related_session' => 'minimum-xor-sum-of-two-arrays',
];
