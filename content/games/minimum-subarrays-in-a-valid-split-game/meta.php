<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Subarrays in a Valid Split: first and last share a factor',
    'leetcode' => 2464,
    'difficulty' => 'Med',
    'summary' => 'dp[i] = fewest subarrays for nums[0 to i). The last subarray nums[j to i−1] is valid if gcd(nums[j], nums[i−1]) > 1: dp[i] = min dp[j] + 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-subarrays-in-a-valid-split',
    'related_session' => 'minimum-subarrays-in-a-valid-split',
];
