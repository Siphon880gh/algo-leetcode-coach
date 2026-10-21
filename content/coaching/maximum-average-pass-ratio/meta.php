<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Average Pass Ratio: heap by marginal gain',
    'leetcode' => 1792,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: push classes keyed by the gain (p + 1)/(t + 1) − p/t; give each extra student to the top class and push it back. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'related_guide' => 'maximum-average-pass-ratio',
    'tags' => ['heap', 'greedy', 'array', 'step-by-step'],
];
