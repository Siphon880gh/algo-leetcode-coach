<?php
declare(strict_types=1);

return [
    'title' => 'Rearrange Sticks With K Visible: Stirling numbers',
    'leetcode' => 1866,
    'difficulty' => 'Hard',
    'summary' => 'Look at where the shortest stick goes. First position: it is visible (dp[n − 1][k − 1]). Any of the other n − 1 positions: it is hidden and blocks nobody ((n − 1) · dp[n − 1][k]).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'combinatorics', 'math', 'leetcode'],
    'related_session' => 'number-of-ways-to-rearrange-sticks-with-k-sticks-visible',
];
