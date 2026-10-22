<?php
declare(strict_types=1);

return [
    'title' => 'Select Cells in Grid With Maximum Score: values outside, rows as a bitmask',
    'leetcode' => 3276,
    'difficulty' => 'Hard',
    'summary' => 'Process distinct values from largest to smallest; for each, take it from one unused row or skip it. With at most 10 rows, memoise on (value index, used-row mask).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'array', 'dynamic-programming', 'bitmask', 'matrix', 'leetcode'],
    'related_session' => 'select-cells-in-grid-with-maximum-score',
];
