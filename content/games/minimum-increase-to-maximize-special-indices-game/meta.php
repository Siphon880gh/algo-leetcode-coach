<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Increase to Maximize Special Indices',
    'leetcode' => 3891,
    'difficulty' => 'Med',
    'summary' => 'Making i special costs max(0, max(nums[i−1], nums[i+1]) + 1 − nums[i]), and special indices cannot be adjacent. The most we can get is ⌊(n−1)/2⌋. DP over i: (count, cost) taking i (jump from i−2) or skipping it, preferring more specials, then less cost.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-increase-to-maximize-special-indices',
    'related_session' => 'minimum-increase-to-maximize-special-indices',
];
