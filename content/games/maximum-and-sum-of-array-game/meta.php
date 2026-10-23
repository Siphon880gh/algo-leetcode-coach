<?php
declare(strict_types=1);

return [
    'title' => 'Maximum AND Sum of Array: two places per slot',
    'leetcode' => 2172,
    'difficulty' => 'Hard',
    'summary' => 'Each slot holds up to 2 numbers. f(i, state) = best AND sum placing nums[i..] given how full each slot is (base-3 state). Try every slot with room: (nums[i] & slot) + f(i + 1, state + 1 in that slot).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-and-sum-of-array',
    'related_session' => 'maximum-and-sum-of-array',
];
