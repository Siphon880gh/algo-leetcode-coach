<?php
declare(strict_types=1);

return [
    'title' => 'Next Greater Element I: monotonic stack over nums2, then look up',
    'leetcode' => 496,
    'difficulty' => 'Easy',
    'summary' => 'For each value of nums1, find the first larger value to its right in nums2, or −1. Walk nums2 with a stack of values still waiting; a larger value pops them and becomes their answer. Store answers in a hash map and read them for nums1. [4,1,2], [1,3,4,2] → [−1,3,−1]. Not 503 / 739.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'kind' => 'algo',
    'tags' => ['stack', 'monotonic-stack', 'hash-table', 'leetcode'],
    'related_session' => 'next-greater-element-i',
];
