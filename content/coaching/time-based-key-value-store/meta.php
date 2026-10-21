<?php
declare(strict_types=1);

return [
    'title' => 'Time Based Key-Value Store: append and bisect',
    'leetcode' => 981,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: each key keeps its timestamps in increasing order, so get binary searches the last timestamp ≤ t. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'related_guide' => 'time-based-key-value-store',
    'tags' => ['binary-search', 'design', 'hash-table', 'step-by-step'],
];
