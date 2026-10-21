<?php
declare(strict_types=1);

return [
    'title' => 'Two Non-overlapping Sub-arrays With Target Sum: best-left array',
    'leetcode' => 1477,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: a sliding window (values are positive) finds each window with sum target; best[i] = shortest window ending ≤ i; combine each window [l, r] with best[l − 1]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'find-two-non-overlapping-sub-arrays-each-with-target-sum',
    'tags' => ['sliding-window', 'dp', 'step-by-step'],
];
