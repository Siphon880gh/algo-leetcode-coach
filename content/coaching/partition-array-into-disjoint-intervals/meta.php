<?php
declare(strict_types=1);

return [
    'title' => 'Partition Array into Disjoint Intervals: move the cut when forced',
    'leetcode' => 915,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep the left part\'s max and the overall max; when an element is smaller than the left max, move the cut to it and the left max becomes the overall max. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Arrays',
    'topic' => 'LeetCode · Arrays',
    'related_guide' => 'partition-array-into-disjoint-intervals',
    'tags' => ['arrays', 'prefix-sum', 'step-by-step'],
];
