<?php
declare(strict_types=1);

return [
    'title' => 'Reverse Subarray To Maximize Array Value: edge gains',
    'leetcode' => 1330,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: only the two boundary differences change, so check prefix and suffix reversals and the interior gain 2 · (max of pair minimums − min of pair maximums). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'reverse-subarray-to-maximize-array-value',
    'tags' => ['greedy', 'math', 'step-by-step'],
];
