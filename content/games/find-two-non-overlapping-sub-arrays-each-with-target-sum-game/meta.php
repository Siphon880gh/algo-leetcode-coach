<?php
declare(strict_types=1);

return [
    'title' => 'Two Non-Overlapping Sub-arrays With Target Sum: best one so far',
    'leetcode' => 1477,
    'difficulty' => 'Med',
    'summary' => 'Sliding window (all positive). When a window [l, r] sums to target, pair it with best[l−1] = shortest window ending before l. Keep best[r] = shortest window ending at or before r.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-two-non-overlapping-sub-arrays-each-with-target-sum',
    'related_session' => 'find-two-non-overlapping-sub-arrays-each-with-target-sum',
];
