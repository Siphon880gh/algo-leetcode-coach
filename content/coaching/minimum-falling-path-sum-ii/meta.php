<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Falling Path Sum II: two smallest per row',
    'leetcode' => 1289,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: keep the previous row\'s smallest path sum, its column, and the second smallest; each cell adds the smallest unless it shares that column. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'minimum-falling-path-sum-ii',
    'tags' => ['dynamic-programming', 'matrix', 'step-by-step'],
];
