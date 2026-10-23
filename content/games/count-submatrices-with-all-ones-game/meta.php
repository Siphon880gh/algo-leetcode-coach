<?php
declare(strict_types=1);

return [
    'title' => 'Count Submatrices With All Ones: heights, then widen left',
    'leetcode' => 1504,
    'difficulty' => 'Med',
    'summary' => 'h[c] = consecutive 1s ending at the current row in column c. For bottom-right corner (r, c), walk left keeping the minimum height: each step adds that minimum.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-submatrices-with-all-ones',
    'related_session' => 'count-submatrices-with-all-ones',
];
