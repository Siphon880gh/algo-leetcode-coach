<?php
declare(strict_types=1);

return [
    'title' => 'Build Array from Permutation: direct indexing',
    'leetcode' => 1920,
    'difficulty' => 'Easy',
    'summary' => 'ans[i] = nums[nums[i]]. For O(1) extra space, store both old and new values in each cell as old + n · new, then divide by n.',
    'category' => 'LeetCode',
    'subcategory' => 'Array',
    'topic' => 'LeetCode · Array',
    'kind' => 'algo',
    'tags' => ['array', 'simulation', 'leetcode'],
    'related_session' => 'build-array-from-permutation',
];
