<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Flips to Convert Binary Matrix to Zero Matrix: BFS over bitmasks',
    'leetcode' => 1284,
    'difficulty' => 'Hard',
    'summary' => 'At most 3 × 3 cells means at most 2⁹ states. Encode the matrix as a bitmask and BFS, where flipping a cell XORs it and its four neighbours, until the mask is 0.',
    'category' => 'LeetCode',
    'subcategory' => 'BFS',
    'topic' => 'LeetCode · BFS',
    'kind' => 'algo',
    'tags' => ['bfs', 'bit-manipulation', 'matrix', 'leetcode'],
    'related_session' => 'minimum-number-of-flips-to-convert-binary-matrix-to-zero-matrix',
];
