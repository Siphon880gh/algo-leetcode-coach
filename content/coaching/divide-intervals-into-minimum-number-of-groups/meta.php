<?php
declare(strict_types=1);

return [
    'title' => 'Divide Intervals Into Minimum Number of Groups: strict end < left, sort by left, smallest end',
    'leetcode' => 2406,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: reuse a group only when it ended strictly before, sort by left end, and compare against the smallest end in a heap. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'related_guide' => 'divide-intervals-into-minimum-number-of-groups',
    'tags' => ['array', 'two-pointers', 'greedy', 'sorting', 'heap', 'prefix-sum', 'step-by-step'],
];
