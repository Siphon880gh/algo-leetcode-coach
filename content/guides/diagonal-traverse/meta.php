<?php
declare(strict_types=1);

return [
    'title' => 'Diagonal Traverse: walk each anti-diagonal i + j = k, alternate direction',
    'leetcode' => 498,
    'difficulty' => 'Med',
    'summary' => 'Return matrix elements in zigzag diagonal order. Cells on one anti-diagonal share i + j = k. For k from 0 to m + n − 2, collect the cells with i + j = k from top-right to bottom-left, and reverse that list when k is even (those go up-right). [[1,2,3],[4,5,6],[7,8,9]] → [1,2,4,7,5,3,6,8,9]. Not 54.',
    'category' => 'LeetCode',
    'subcategory' => 'Matrix',
    'topic' => 'LeetCode · Matrix',
    'kind' => 'algo',
    'tags' => ['matrix', 'simulation', 'arrays', 'leetcode'],
    'related_session' => 'diagonal-traverse',
];
