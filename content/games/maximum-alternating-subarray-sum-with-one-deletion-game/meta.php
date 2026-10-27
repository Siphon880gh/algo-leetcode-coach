<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Alternating Subarray Sum with One Deletion',
    'leetcode' => 4072,
    'difficulty' => 'Med',
    'summary' => 'Four states end at each index. e0 and o0 add or subtract nums[i] with nothing deleted. e1 and o1 have one deletion used, always the element just before i. e0 = nums[i] + max(0, o0 before); o0 = −nums[i] + e0 before; e1 = nums[i] + max(o1 before, o0 two back); o1 = −nums[i] + max(e1 before, e0 two back).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-alternating-subarray-sum-with-one-deletion',
    'related_session' => 'maximum-alternating-subarray-sum-with-one-deletion',
];
