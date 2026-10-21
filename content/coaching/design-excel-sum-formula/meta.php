<?php
declare(strict_types=1);

return [
    'title' => 'Design Excel Sum Formula: keep the formula, not the number',
    'leetcode' => 631,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: store a sum as a map from cell to count, count repeated references twice, and evaluate get recursively. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'design-excel-sum-formula',
    'tags' => ['design', 'graph', 'hash-table', 'step-by-step'],
];
