<?php
declare(strict_types=1);

return [
    'title' => 'Knight Dialer: DP over ten digits',
    'leetcode' => 935,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: the state is only the current digit; each step, a digit\'s count is the sum over digits a knight can jump from, repeated n − 1 times. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'knight-dialer',
    'tags' => ['dynamic-programming', 'graphs', 'step-by-step'],
];
