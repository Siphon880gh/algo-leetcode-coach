<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Alternating Subarray Sum: plus-ending and minus-ending',
    'leetcode' => 2036,
    'difficulty' => 'Med',
    'summary' => 'plus = best alternating sum of a subarray ending here with nums[i] added = max(nums[i], minus + nums[i]); minus = best ending here with nums[i] subtracted = plus_prev − nums[i].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-alternating-subarray-sum',
    'related_session' => 'maximum-alternating-subarray-sum',
];
