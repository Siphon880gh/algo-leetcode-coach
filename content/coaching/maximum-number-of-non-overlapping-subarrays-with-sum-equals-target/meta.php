<?php
declare(strict_types=1);

return [
    'title' => 'Max Non-Overlapping Subarrays With Target Sum: reset on match',
    'leetcode' => 1546,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep prefix sums since the last cut; when current − target is present, count one and reset. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'maximum-number-of-non-overlapping-subarrays-with-sum-equals-target',
    'tags' => ['greedy', 'prefix-sum', 'hash-table', 'step-by-step'],
];
