<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Score of a Good Subarray: expand from k',
    'leetcode' => 1793,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: start at [k, k]; grow toward the larger neighbour, updating the minimum and best min · length. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'related_guide' => 'maximum-score-of-a-good-subarray',
    'tags' => ['two-pointers', 'greedy', 'monotonic-stack', 'step-by-step'],
];
