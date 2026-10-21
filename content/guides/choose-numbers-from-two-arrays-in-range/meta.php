<?php
declare(strict_types=1);

return [
    'title' => 'Choose Numbers From Two Arrays in Range: DP over the running difference',
    'leetcode' => 2143,
    'difficulty' => 'Hard',
    'summary' => 'Track, for ranges ending at i, how many choice sequences give each difference (sum of picked nums1 − sum of picked nums2). Extend every previous difference by +nums1[i] or −nums2[i], start new ranges at i, and add the count at difference 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'array', 'leetcode'],
    'related_session' => 'choose-numbers-from-two-arrays-in-range',
];
