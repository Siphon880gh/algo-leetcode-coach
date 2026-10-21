<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Ways to Partition an Array: left and right counters',
    'leetcode' => 2025,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: diffs prefix − suffix per pivot, a change by d shifts pivots after i up and the rest down, counters on each side. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'related_guide' => 'maximum-number-of-ways-to-partition-an-array',
    'tags' => ['prefix-sum', 'hash-table', 'counting', 'step-by-step'],
];
