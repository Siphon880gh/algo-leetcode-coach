<?php
declare(strict_types=1);

return [
    'title' => 'Reshape the Matrix: map flat index k to (k // c, k % c)',
    'leetcode' => 566,
    'difficulty' => 'Easy',
    'summary' => 'Reshape an m × n matrix into r × c in row-major order, or return it unchanged if m × n ≠ r × c. Element k (k = i × n + j) goes to row k // c, column k % c. [[1,2],[3,4]], 1, 4 → [[1,2,3,4]]. [[1,2],[3,4]], 2, 4 → unchanged.',
    'category' => 'LeetCode',
    'subcategory' => 'Matrix',
    'topic' => 'LeetCode · Matrix',
    'kind' => 'algo',
    'tags' => ['matrix', 'arrays', 'simulation', 'leetcode'],
    'related_session' => 'reshape-the-matrix',
];
