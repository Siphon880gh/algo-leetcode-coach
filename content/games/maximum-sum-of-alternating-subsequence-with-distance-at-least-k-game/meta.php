<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Sum of Alternating Subsequence With Distance at Least K',
    'leetcode' => 3915,
    'difficulty' => 'Hard',
    'summary' => 'up[i] = best sum ending at i where the last step went up (previous value smaller), down[i] the opposite. up[i] = nums[i] + max(nums-alone, down[j]) over j ≤ i − k with nums[j] < nums[i]. Segment trees keyed by value over the indices that became eligible give O(n log n).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-sum-of-alternating-subsequence-with-distance-at-least-k',
    'related_session' => 'maximum-sum-of-alternating-subsequence-with-distance-at-least-k',
];
