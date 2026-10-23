<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Ways to Partition an Array',
    'leetcode' => 2025,
    'difficulty' => 'Hard',
    'summary' => 'A pivot works when prefix = total / 2. Changing nums[i] to k shifts total by δ = k − nums[i]: pivots left of i need prefix = (total + δ)/2, pivots at or after i need prefix + δ = (total + δ)/2. Count with left/right prefix maps.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-number-of-ways-to-partition-an-array',
    'related_session' => 'maximum-number-of-ways-to-partition-an-array',
];
