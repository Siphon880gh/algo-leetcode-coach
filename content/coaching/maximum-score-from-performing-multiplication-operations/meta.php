<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Score from Performing Multiplication Operations: DP on left count',
    'leetcode' => 1770,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: dp over (operation i, left picks l); the right index is n − 1 − (i − l); take the better of left and right. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'maximum-score-from-performing-multiplication-operations',
    'tags' => ['dynamic-programming', 'array', 'step-by-step'],
];
