<?php
declare(strict_types=1);

return [
    'title' => 'Kth Largest Element in a Stream: keep only k',
    'leetcode' => 703,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: a min-heap of the k largest values, pop when it grows past k, and read the root. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'related_guide' => 'kth-largest-element-in-a-stream',
    'tags' => ['heap', 'design', 'step-by-step'],
];
