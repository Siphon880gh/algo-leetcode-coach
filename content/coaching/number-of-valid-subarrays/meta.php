<?php
declare(strict_types=1);

return [
    'title' => 'Number of Valid Subarrays: next smaller element',
    'leetcode' => 1063,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: a subarray starting at i stays valid until the first later element strictly smaller than nums[i]; find it with a monotonic stack and add the distance. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'related_guide' => 'number-of-valid-subarrays',
    'tags' => ['stack', 'monotonic-stack', 'arrays', 'step-by-step'],
];
