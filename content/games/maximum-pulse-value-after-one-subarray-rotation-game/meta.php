<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Pulse Value After One Subarray Rotation',
    'leetcode' => 4058,
    'difficulty' => 'Med',
    'summary' => 'Left-rotating nums[l..r] sends nums[l] to position r and shifts nums[l + 1..r] left by one, which flips all their signs. With signed prefix sums each (l, r) gain is O(1), so scan r and keep the best l. The answer is base + max(0, best gain).',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-pulse-value-after-one-subarray-rotation',
    'related_session' => 'maximum-pulse-value-after-one-subarray-rotation',
];
