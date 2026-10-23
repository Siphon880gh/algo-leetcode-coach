<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Transform Array: one extra copy',
    'leetcode' => 3724,
    'difficulty' => 'Med',
    'summary' => 'Fix each nums1[i] into nums2[i] at a cost of |difference|, plus 1 for the append. Copy whichever element passes closest to nums2[n] while it moves; the extra cost is the distance from nums2[n] to the range between nums1[i] and nums2[i].',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'leetcode'],
    'related_session' => 'minimum-operations-to-transform-array',
];
