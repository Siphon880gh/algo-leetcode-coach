<?php
declare(strict_types=1);

return [
    'title' => 'Matrix Diagonal Sum: both diagonals, centre once',
    'leetcode' => 1572,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: add mat[i][i] and mat[i][n − 1 − i] for every row; if n is odd, subtract the centre once. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Matrix',
    'topic' => 'LeetCode · Matrix',
    'related_guide' => 'matrix-diagonal-sum',
    'tags' => ['matrix', 'arrays', 'step-by-step'],
];
