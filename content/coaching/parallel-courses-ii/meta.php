<?php
declare(strict_types=1);

return [
    'title' => 'Parallel Courses II: bitmask DP with submasks',
    'leetcode' => 1494,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: state = taken mask; available = untaken courses whose prerequisites are all taken; take all if ≤ k, else try each k-subset. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'parallel-courses-ii',
    'tags' => ['dp', 'bitmask', 'graph', 'step-by-step'],
];
