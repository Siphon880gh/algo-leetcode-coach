<?php
declare(strict_types=1);

return [
    'title' => 'Design a Number Container System: lazy heaps and a hash map',
    'leetcode' => 2349,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep a min-heap of indices per number, discard stale tops on find, and store indices in a hash map. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'design-a-number-container-system',
    'tags' => ['design', 'hash-table', 'ordered-set', 'heap', 'step-by-step'],
];
