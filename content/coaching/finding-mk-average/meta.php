<?php
declare(strict_types=1);

return [
    'title' => 'Finding MK Average: three sorted buckets over a window',
    'leetcode' => 1825,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: keep the last m values split into low (k smallest), mid and high (k largest) sorted multisets with a running mid sum; rebalance on each add and eviction. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'finding-mk-average',
    'tags' => ['design', 'ordered-set', 'queue', 'step-by-step'],
];
