<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Split an Array: k plus the repeated elements',
    'leetcode' => 2547,
    'difficulty' => 'Hard',
    'summary' => 'importance(sub) = k + (number of elements whose value repeats in sub). dp[i] = min over j of dp[j] + importance(nums[j..i−1]), growing j leftward while counting repeats.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-cost-to-split-an-array',
    'related_session' => 'minimum-cost-to-split-an-array',
];
