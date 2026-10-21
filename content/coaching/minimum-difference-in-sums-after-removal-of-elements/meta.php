<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Difference in Sums After Removal of Elements: split and heaps',
    'leetcode' => 2163,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: try every split from n to 2n, keep the n smallest on the left with a max-heap and the n largest on the right with a min-heap. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'related_guide' => 'minimum-difference-in-sums-after-removal-of-elements',
    'tags' => ['array', 'dynamic-programming', 'heap', 'step-by-step'],
];
