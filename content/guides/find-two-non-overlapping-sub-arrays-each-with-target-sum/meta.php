<?php
declare(strict_types=1);

return [
    'title' => 'Find Two Non-overlapping Sub-arrays Each With Target Sum: best-so-far prefix',
    'leetcode' => 1477,
    'difficulty' => 'Med',
    'summary' => 'Values are positive, so a sliding window finds every subarray with sum target. Keep best[i] = shortest such window ending at or before i; when a window [l, r] matches, combine it with best[l − 1].',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['sliding-window', 'dp', 'leetcode'],
    'related_session' => 'find-two-non-overlapping-sub-arrays-each-with-target-sum',
];
