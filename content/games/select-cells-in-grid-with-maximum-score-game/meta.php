<?php
declare(strict_types=1);

return [
    'title' => 'Select Cells With Maximum Score: values high to low, mask of used rows',
    'leetcode' => 3276,
    'difficulty' => 'Hard',
    'summary' => 'Distinct values, at most one per row. Go through values in decreasing order; dp[mask] = best sum using the rows in mask. A value can be placed in any unused row that contains it.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'select-cells-in-grid-with-maximum-score',
    'related_session' => 'select-cells-in-grid-with-maximum-score',
];
