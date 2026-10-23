<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Length of Repeated Subarray: extend the diagonal',
    'leetcode' => 718,
    'difficulty' => 'Med',
    'summary' => 'dp[i][j] = length of the common run ending at nums1[i−1] and nums2[j−1]: diagonal + 1 if they are equal, else 0. Track the max.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-length-of-repeated-subarray',
    'related_session' => 'maximum-length-of-repeated-subarray',
];
