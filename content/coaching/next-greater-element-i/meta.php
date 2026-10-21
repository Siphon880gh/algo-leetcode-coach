<?php
declare(strict_types=1);

return [
    'title' => 'Next Greater Element I: monotonic stack over nums2, then look up',
    'leetcode' => 496,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: for each nums1 value, the first larger value to its right in nums2, or −1. One monotonic stack pass over nums2 fills a map; read it for nums1. [4,1,2], [1,3,4,2] → [−1,3,−1]. Not 503 / 739. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'tags' => ['monotonic-stack', 'hash-table', 'stack', 'step-by-step'],
    'related_guide' => 'next-greater-element-i',
];
