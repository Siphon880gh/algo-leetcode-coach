<?php
declare(strict_types=1);

return [
    'title' => 'Build Array from Permutation: nums[nums[i]]',
    'leetcode' => 1920,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: ans[i] = nums[nums[i]]; for O(1) space, pack old and new values as old + n · new. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Array',
    'topic' => 'LeetCode · Array',
    'related_guide' => 'build-array-from-permutation',
    'tags' => ['array', 'simulation', 'step-by-step'],
];
