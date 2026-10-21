<?php
declare(strict_types=1);

return [
    'title' => 'Diagonal Traverse: walk each anti-diagonal i + j = k, alternate direction',
    'leetcode' => 498,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: matrix in zigzag diagonal order. Cells on a diagonal share i + j = k. For each k, list cells from top-right to bottom-left, reversed when k is even. [[1,2,3],[4,5,6],[7,8,9]] → [1,2,4,7,5,3,6,8,9]. Not 54. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Matrix',
    'topic' => 'LeetCode · Matrix',
    'tags' => ['matrix', 'simulation', 'arrays', 'step-by-step'],
    'related_guide' => 'diagonal-traverse',
];
