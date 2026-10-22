<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Score From Grid Operations: DP on neighbouring heights',
    'leetcode' => 3225,
    'difficulty' => 'Hard',
    'summary' => 'Each column is painted to some height. A white cell scores when a neighbouring column is taller, so a column’s score depends on its own height and the larger neighbour height. Run a DP over (previous height, current height), with prefix and suffix maxima to keep each column at O(n²).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'matrix', 'prefix-sum', 'leetcode'],
    'related_session' => 'maximum-score-from-grid-operations',
];
