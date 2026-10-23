<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Path Score in a Grid: DP over cost',
    'leetcode' => 3742,
    'difficulty' => 'Med',
    'summary' => 'Values 1 and 2 both cost 1, value 0 costs nothing. dp[i][j][c] = best score reaching (i, j) with cost exactly c, from the cell above or to the left.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'matrix', 'leetcode'],
    'related_session' => 'maximum-path-score-in-a-grid',
];
