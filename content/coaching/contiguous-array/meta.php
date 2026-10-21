<?php
declare(strict_types=1);

return [
    'title' => 'Contiguous Array: map 0 to −1, longest zero-sum subarray',
    'leetcode' => 525,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: longest subarray with equal 0s and 1s. Count 0 as −1, 1 as +1; equal prefix sums bound a balanced subarray. First index of each prefix with {0: −1}; answer max i − first[s]. [0,1,0] → 2. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'hash-table', 'step-by-step'],
    'related_guide' => 'contiguous-array',
];
